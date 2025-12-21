<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('setting')) {

    function setting($key, $default = null)
    {
        $settings = Cache::rememberForever('settings_cache', function () {
            return DB::table('settings')->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('tenantUrl')) {
    function tenantUrl($user)
    {
        $scheme = request()->getScheme();
        $port = (config('app.env') === 'local') ? ':8000' : '';
        if ($user->domain) {
            return "{$scheme}://{$user->domain}{$port}";
        }
        
        $baseDomain = parse_url(config('app.url'), PHP_URL_HOST);

        return "{$scheme}://{$user->username}.{$baseDomain}{$port}";
    }
}
