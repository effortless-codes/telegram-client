<?php

namespace Winata\Core\Telegram\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;
use Winata\Core\Telegram\Concerns\Messages\Message;
use Winata\Core\Telegram\Enums\Status;
use Winata\Core\Telegram\Models\TelegramLog;
use Winata\Core\Telegram\Service\TelegramService;

trait HasTelegramMessages
{
    private ?string $parseMode = null;

    /**
     * @param string $mode
     * @return $this
     */
    public function setParseMode(string $mode = 'markdown'): static
    {
        $this->parseMode = $mode;
        return $this;
    }

    public string $message = '';

    /**
     * @param string|null $message
     * @param string|null $format
     * @return $this
     */
    public function setMessage(string $message = null, string $format = null, callable $callable = null): static
    {
        if (isset($message)) {
            $this->message .= "{$format}{$message}{$format}" . PHP_EOL;
        }

        if ($callable) {
            $message = $callable(new Message());
            if (is_null($message)) {
                return $this;
            }
            $this->message .= $message->message;
        }


        return $this;
    }

    public ?string $reply = null;

    /**
     * @param string|int $messageId
     * @return $this
     */
    public function reply(string|int $messageId): static
    {
        $this->reply = $messageId;
        return $this;
    }

}
