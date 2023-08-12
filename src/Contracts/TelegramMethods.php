<?php
namespace Winata\Core\Telegram\Contracts;
interface TelegramMethods
{
    public function getMe(): array;
    public function getUpdates(): array;
    public function sendMessage(): void;
//    public function forwardMessage(string $mode = 'markdown'): static;
//    public function copyMessage(string $message = null): static;
//    public function sendPhoto(string $message = null, string $format = null, callable $callable = null): static;
//    public function sendAudio(string $message = null): static;
//    public function sendDocument(string|int $chatId): static;
//    public function sendVideo(): void;
//    public function Animation(): void;
}
