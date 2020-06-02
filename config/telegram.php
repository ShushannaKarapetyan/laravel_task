<?php

return [
    'bot_token' => env('TELEGRAM_BOT_TOKEN'),
    'bots' => [
        'mybot' => [
            'username' => 'LaravelNotifier',
            'token' => env('TELEGRAM_BOT_TOKEN', ''),
            //'certificate_path' => env('TELEGRAM_CERTIFICATE_PATH', ''),
            //'webhook_url' => env('TELEGRAM_WEBHOOK_URL', ''),
            'commands' => [
            ],
        ],
    ],

];
