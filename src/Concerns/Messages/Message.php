<?php

namespace Winata\Core\Telegram\Concerns\Messages;
class Message
{
    public string $message = '';

    /**
     * @param string|null $message
     * @param string|null $format
     * @return $this
     */
    public function setMessage(string $message = null, string $format = null): static
    {
        $this->message .= "{$format}{$message}{$format}" . PHP_EOL;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}