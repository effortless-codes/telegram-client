<?php

namespace Winata\Core\Telegram\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelegramBot extends Model
{
    use SoftDeletes;

    protected $table = 'telegram_bots';

    protected $fillable = [
        'bot_id',
        'is_bot',
        'first_name',
        'username',
        'is_enabled',
    ];

}
