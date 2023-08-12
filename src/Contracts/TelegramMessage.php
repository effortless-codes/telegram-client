<?php
namespace Winata\Core\Telegram\Contracts;
interface TelegramMessage
{
    public function setParseMode(string $mode = 'markdown'): static;
    public function setMessage(string $message = null, string $format = null, callable $callable = null): static;
    public function reply(string|int $chatId): static;
}
