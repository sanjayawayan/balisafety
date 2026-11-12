<?php

use App\Services\TranslationService;

if (!function_exists('__t')) {
    function __t(string $key, ?string $default = null): string
    {
        return TranslationService::trans($key, $default);
    }
}
