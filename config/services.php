<?php

return [
    'admin' => [
        'username' => env('ADMIN_USERNAME'),
        'password' => env('ADMIN_PASSWORD'),
    ],
    'vercel_blob' => [
        'token' => env('BLOB_READ_WRITE_TOKEN'),
        'store_id' => env('BLOB_STORE_ID'),
    ],
    'gemini' => [
        'key' => env('GEMINI_API_KEY'),
        'model' => env('GEMINI_MODEL', 'gemini-3.5-flash-lite'),
        'base_url' => env('GEMINI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta'),
    ],
];
