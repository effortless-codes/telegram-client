<?php

namespace Winata\Core\Telegram\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramChat extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'telegram_chats';

    protected $fillable = [
        'type',
        'chat_id',
        'username',
        'is_enabled',
    ];

}
