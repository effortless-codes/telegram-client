<?php
namespace Winata\Core\Telegram\Concerns;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;
use Winata\Core\Telegram\Enums\Status;
use Winata\Core\Telegram\Models\TelegramLog;
use Winata\Core\Telegram\Service\TelegramService;

trait HasTelegramMethod
{

    /**
     * @return array
     */
    public function getMe(): array
    {
        $url = $this->telegramApiBaseUrl . $this->token . '/getMe';
        $response = Http::post($url);
        return $response->json();

    }

    /**
     * @return array
     */
    public function getUpdates(): array
    {
        $url = $this->telegramApiBaseUrl . $this->token . '/getUpdates';
        $response = Http::post($url);
        return $response->json();

    }

    /**
     * @return void
     */
    public function sendMessage(): void
    {

        $message = $this->message;

        if (isset($this->title)){
            $message = $this->title . PHP_EOL . PHP_EOL . $message;
        }

        if (isset($this->cc)){
            $message = $message . PHP_EOL . $this->cc;
        }else{
            $this->cc = config('winata.telegram.formatting.cc') ?? null;
        }

        $telegram = null;
        if (config('winata.telegram.logging')){
            $telegram = TelegramService::create(inputs: [
                'bot_id' => null,
                'telegram_chat_id' => null,
                'reply_id' => $this->reply,
                'type' => null,
                'message_id' => null,
                'chat_id' => $this->chatId,
                'title' => $this->title,
                'status' => Status::PENDING->value,
                'message' => $message,
                'data' => null,
                'log' => null,

                'sending_at' => null,
                'failed_at' => null,
            ]);
        }

        $url = $this->telegramApiBaseUrl . $this->token . '/sendMessage';
        $response = Http::post($url, [
            'reply_to_message_id' => $this->reply,
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);

        $response = new Fluent($response->json());

        if ($telegram instanceof TelegramLog){
            if ($response->ok) {

                $result = array_to_object($response->result);
                TelegramService::update(
                    log: $telegram,
                    status: Status::SUCCESS,
                    result: $result
                );
            }
            if (!$response->ok) {
                $result = array_to_object($response);
                TelegramService::update(
                    log: $telegram,
                    status: Status::FAILED,
                    result: $result
                );
            }
        }
    }
}
