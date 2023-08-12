<?php

namespace Winata\Core\Telegram;

use Winata\Core\Telegram\Abstracts\TelegramSupport;
use Winata\Core\Telegram\Concerns\HasTelegramMessages;
use Winata\Core\Telegram\Concerns\HasTelegramMethod;
use Winata\Core\Telegram\Contracts\TelegramMessage;
use Winata\Core\Telegram\Contracts\TelegramMethods;

class Telegram extends TelegramSupport implements TelegramMethods, TelegramMessage
{
    use HasTelegramMessages;
    use HasTelegramMethod;

    /**
     * @param string|null $chatId
     * @param string|null $token
     */
    public function __construct(
        public ?string $token = null,
        public ?string $chatId = null,
    )
    {
        if (is_null($this->chatId)) {
            $this->chatId = config('winata.telegram.chat_id');
        }

        if (is_null($this->token)) {
            $this->token = config('winata.telegram.token');
        }

        $this->title = config('winata.telegram.formatting.title') ?? null;
    }


}
