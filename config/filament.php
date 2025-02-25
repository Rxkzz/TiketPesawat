<?php

use Filament\Panel;
use Filament\Support\Colors\Color;

return [
    'default_filesystem_disk' => env('FILAMENT_FILESYSTEM_DISK', 'public'),
    
    'layout' => [
        'sidebar' => [
            'is_collapsible_on_desktop' => true,
        ],
        'footer' => [
            'should_show_logo' => false,
        ],
    ],
    
    'favicon' => null,
    
    'middleware' => [
        'auth' => [
            \Filament\Http\Middleware\Authenticate::class,
        ],
        'base' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ],

    'uploads' => [
        'disk' => 'public',
        'directory' => 'uploads',
        'visibility' => 'public',
        'temporary_upload' => [
            'disk' => 'local',
            'directory' => 'tmp',
            'middleware' => null,
            'preview_url_middleware' => null,
        ],
    ],

    'dark_mode' => [
        'enabled' => true,
    ],

    'broadcasting' => [
        'echo' => [
            'broadcaster' => 'pusher',
            'key' => env('VITE_PUSHER_APP_KEY'),
            'cluster' => env('VITE_PUSHER_APP_CLUSTER'),
            'forceTLS' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
    'pages' => [
        'namespace' => 'App\\Filament\\Pages',
        'path' => app_path('Filament/Pages'),
        'register' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    */
    'resources' => [
        'namespace' => 'App\\Filament\\Resources',
        'path' => app_path('Filament/Resources'),
        'register' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    */
    'widgets' => [
        'namespace' => 'App\\Filament\\Widgets',
        'path' => app_path('Filament/Widgets'),
        'register' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */
    'livewire' => [
        'namespace' => 'App\\Filament',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'guard' => env('FILAMENT_AUTH_GUARD', 'web'),
        'pages' => [
            'login' => \Filament\Pages\Auth\Login::class,
        ],
    ],

    'colors' => [
        'primary' => Color::Purple,
        'gray' => Color::Slate,
        'info' => Color::Blue,
        'success' => Color::Emerald,
        'warning' => Color::Orange,
        'danger' => Color::Rose,
    ],

    'theme' => [
        'sidebar' => [
            'background' => 'bg-gradient-to-b from-purple-600 to-purple-900',
            'color' => 'text-white',
        ],
        'topbar' => [
            'background' => 'bg-white dark:bg-gray-800',
        ],
    ],
]; 