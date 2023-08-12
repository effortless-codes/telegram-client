<?php
namespace Winata\Core\Telegram\Enums;
enum ChatType: string
{
    case CHANNEL = 'Channel';
    case PERSONAL_CHAT = 'PersonalChat';
    case GROUP = 'Group';
}
