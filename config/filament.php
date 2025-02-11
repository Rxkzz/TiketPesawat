<?php

return [
    'default_filesystem_disk' => 'public',
    
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
]; 