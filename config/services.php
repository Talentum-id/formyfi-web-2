<?php

return [
    'discord' => [
        'client_id' => env('DISCORD_CLIENT_ID'),
        'client_secret' => env('DISCORD_CLIENT_SECRET'),
        'redirect' => env('DISCORD_CALLBACK_URL'),
    ],
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],
    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],
    'recaptcha' => [
        'key' => env('GOOGLE_CAPTCHA_KEY'),
        'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
    ],
    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_CALLBACK_URL'),
    ],
    'social_verifiers' => [
        'discord_endpoint' => env('DISCORD_ENDPOINT'),
        'twitter_endpoint' => env('TWITTER_ENDPOINT'),
        'twitter_api_key' => env('TWITTER_API_KEY'),
    ],
    'token_sender' => [
        'uri' => env('TOKEN_SENDER_URI'),
        'access_token' => env('TOKEN_SENDER_ACCESS_TOKEN'),
        'mode' => env('TOKEN_SENDER_MODE', 'mainnet'),
    ],
    'test_uris' => env('TEST_URIS'),
];
