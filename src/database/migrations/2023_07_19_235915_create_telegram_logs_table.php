<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Winata\Core\Telegram\Models\TelegramBot;
use Winata\Core\Telegram\Models\TelegramChat;
use Winata\Core\Telegram\Models\TelegramLog;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('telegram_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('bot_id')
                ->nullable()
                ->constrained('telegram_bots')
                ->onDelete('cascade');

            $table->foreignIdFor(TelegramChat::class, 'telegram_chat_id')
                ->nullable()
                ->constrained((new TelegramChat())->getTable())
                ->onDelete('cascade');

            $table->string('reply_id')->nullable();

            $table->string('type')->nullable()->comment('type chat_id');
            $table->string('message_id')->nullable();
            $table->string('chat_id');
            $table->string('title');
            $table->string('status');
            $table->text('message');
            $table->jsonb('data')->nullable();
            $table->jsonb('log')->nullable();

            $table->timestamp('sending_at')->nullable();
            $table->timestamp('failed_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('telegram_logs');
    }
};
