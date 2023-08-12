<?php
namespace Winata\Core\Telegram\Enums;

enum Status: string
{
    case PENDING = 'Pending';
    case SUCCESS = 'Success';
    case FAILED = 'Failed';
}
