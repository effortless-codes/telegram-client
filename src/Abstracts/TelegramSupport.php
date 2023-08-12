<?php

namespace Winata\Core\Telegram\Abstracts;

use Winata\Core\Telegram\Concerns\HasTelegramMethod;
use Winata\Core\Telegram\Concerns\Messages\Message;
use Winata\Core\Telegram\Contracts\Telegramable;

abstract class TelegramSupport implements Telegramable
{
    use HasTelegramMethod;

    public string $telegramApiBaseUrl = "https://api.telegram.org/bot";

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): static
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param int|string $chatId
     * @return $this
     */
    public function setChat(int|string $chatId): static
    {
        $this->chatId = $chatId;
        return $this;
    }

    public string $title;

    /**
     * @param string|null $title
     * @return $this
     */
    public function setTitle(string $title = null, callable $callable = null): static
    {
        if (isset($title)) {
            $this->title .= $title . PHP_EOL;
        }
        if ($callable) {
            $message = $callable(new Message());
            if (is_null($message)) {
                return $this;
            }
            $this->title = $message->message;
        }
        return $this;
    }

    public string $cc;

    /**
     * @param string|null $cc
     * @return $this
     */
    public function setCc(string $cc = null, callable $callable = null): static
    {
        if (isset($cc)) {
            $this->cc .= $cc . PHP_EOL;
        }
        if ($callable) {
            $message = $callable(new Message());
            if (is_null($message)) {
                return $this;
            }

            $this->cc = $message->message;
        }
        return $this;
    }
}
