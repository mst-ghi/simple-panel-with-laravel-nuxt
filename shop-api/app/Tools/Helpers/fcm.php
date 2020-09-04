<?php

if (!function_exists('setConfigFcm')) {
    /**
     * @param string|NULL $driver
     * @param string|NULL $serverKey
     * @param string|NULL $senderId
     */
    function setConfigFcm(string $driver = NULL, string $serverKey = NULL, string $senderId = NULL)
    {

        config([
            'fcm.driver'          => $driver ?? 'http',
            'fcm.http.server_key' => $serverKey ?? getFcmServerKey(),
            'fcm.http.sender_id'  => $senderId ?? getFcmSenderId(),
        ]);

    }
}

if (!function_exists('getFcmServerKey')) {
    /**
     * @return string
     */
    function getFcmServerKey()
    {
        return 'server key here';
    }
}

if (!function_exists('getFcmSenderId')) {
    /**
     * @return string
     */
    function getFcmSenderId()
    {
        return 'sender id here';
    }
}





