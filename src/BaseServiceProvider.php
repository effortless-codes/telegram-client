<?php

namespace Winata\Core\Telegram;

use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/winata/telegram.php', 'winata.telegram');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/../config/winata/telegram.php' => config_path('winata/telegram.php')], 'config');
        $this->publishes([__DIR__.'/database/migrations/2023_07_19_235913_create_telegram_bots_table.php' => database_path('migrations/2023_07_19_235913_create_telegram_bots_table.php')], 'database');
        $this->publishes([__DIR__.'/database/migrations/2023_07_19_235914_create_telegram_chats_table.php' => database_path('migrations/2023_07_19_235914_create_telegram_chats_table.php')], 'database');
        $this->publishes([__DIR__.'/database/migrations/2023_07_19_235915_create_telegram_logs_table.php' => database_path('migrations/2023_07_19_235915_create_telegram_logs_table.php')], 'database');
    }
}
