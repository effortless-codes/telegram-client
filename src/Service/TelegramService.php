<?php
namespace Winata\Core\Telegram\Service;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;
use Winata\Core\Telegram\Enums\Status;
use Winata\Core\Telegram\Models\TelegramBot;
use Winata\Core\Telegram\Models\TelegramChat;
use Winata\Core\Telegram\Models\TelegramLog;

class TelegramService
{
    /**
     * @param array $inputs
     * @param object $data
     * @return Builder|Model|TelegramLog
     */
    public static function create(array $inputs): Model|Builder|TelegramLog
    {
        DB::beginTransaction();
        $inputs = getFillableAttribute(TelegramLog::class, $inputs);

        $newLog = TelegramLog::query()
            ->create($inputs);

        DB::commit();
        return $newLog;
    }

    /**
     * @param TelegramLog $log
     * @param Status $status
     * @param object $result
     * @return void
     */
    public static function update(TelegramLog $log, Status $status, object $result): void
    {

        if ($status->value == Status::SUCCESS->value){
            $inputs = [
                'message_id' => $result->message_id,
                'chat_id' => $result->chat->id,
                'type' => $result->chat->type,
                'status' => $status->value,
                'data' => $result,
                'log' => $result->from,

                'sending_at' => Carbon::now(),
            ];
            $sender = self::checkSender(senderId: $result->chat->id, sender: new Fluent($result->from));
            $inputs['bot_id'] = $sender->id;

            $receiver = self::checkReceiver(receiverId: $result->chat->id, receiver: new Fluent($result->chat));
            $inputs['telegram_chat_id'] = $receiver->id;
        }

        if ($status->value == Status::FAILED->value){
            $inputs = [
                'log' => $result,
                'status' => $status->value,
            ];
            $inputs['failed_at'] = Carbon::now();
        }
        $log->fill($inputs);
        $log->save();
    }


    /**
     * @param string $senderId
     * @param Fluent $sender
     * @return Builder|Model|TelegramBot
     */
    private static function checkSender(string $senderId, Fluent $sender): Builder|Model|TelegramBot
    {
        return TelegramBot::query()
            ->firstOrCreate([
                'bot_id' => $senderId
            ], [
                'bot_id' => $senderId,
                'is_bot' => $sender->is_bot,
                'first_name' => $sender->first_name,
                'username' => $sender->username,
                'is_enabled' => true,
            ]);
    }

    /**
     * @param string $receiverId
     * @param Fluent $receiver
     * @return Builder|Model|TelegramChat
     */
    private static function checkReceiver(string $receiverId, Fluent $receiver): Builder|Model|TelegramChat
    {
        return TelegramChat::query()
            ->firstOrCreate([
                'chat_id' => $receiverId
            ], [
                'type' => $receiver->type,
                'chat_id' => $receiverId,
                'username' => $receiver->username,
                'is_enabled' => true,
            ]);
    }
}
