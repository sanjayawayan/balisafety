<?php

return [
    'admin' => [
        'username' => env('ADMIN_USERNAME', 'admin'),
        'password' => env('ADMIN_PASSWORD', 'baliguard2026'),
    ],
    'gemini' => [
        'key' => env('GEMINI_API_KEY'),
        'model' => env('GEMINI_MODEL', 'gemini-3.5-flash-lite'),
        'base_url' => env('GEMINI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta'),
    ],
];
