<?php


use Illuminate\Support\Arr;
use Winata\Core\Telegram\Telegram;

if (!function_exists('sendToTelegram')) {
    /**
     * @param string|null $token
     * @param string|null $chatId
     * @return Telegram
     */
    function sendToTelegram(?string $token = null, ?string $chatId = null): Telegram
    {
        return (new Telegram(token: $token, chatId: $chatId));
    }
}

if (!function_exists('getFillableAttribute')) {

    /**
     * Convert Array into Object in deep
     *
     * @param string $model
     * @param array $data
     * @return array
     */
    function getFillableAttribute(string $model, array $data): array
    {
        $fillable = (new $model)->getFillable();

        return Arr::only($data, Arr::flatten($fillable));
    }
}

if (!function_exists('array_to_object')) {

    /**
     * Convert Array into Object in deep
     *
     * @param array $array
     * @return
     */
    function array_to_object($array)
    {
        return json_decode(json_encode($array));
    }
}
