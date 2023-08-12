<?php
namespace Winata\Core\Telegram\Contracts;
interface Telegramable
{
    public function setToken(string $token): static;
    public function setChat(int|string $chatId): static;
    public function setTitle(string $title = null, callable $callable = null): static;
    public function setCc(string $cc = null, callable $callable = null): static;
}
