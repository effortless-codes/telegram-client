<?php

namespace Winata\Core\Telegram\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramLog extends Model
{
    use SoftDeletes, HasUuids;

    protected $table = 'telegram_logs';

    protected $fillable = [
        'bot_id',
        'telegram_chat_id',
        'reply_id',
        'message_id',
        'type',
        'chat_id',
        'title',
        'status',
        'message',
        'data',
        'log',

        'sending_at',
        'failed_at',
    ];

    protected $casts = [
        'url' => 'array',
        'data' => 'array',
        'log' => 'array',
        'sending_at' => 'timestamp',
        'failed_At' => 'timestamp',
    ];
}
