<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SessionGuard
{
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        $sessionConfig = Config::get('session.domain_guard');

        // Set session name berdasarkan path
        if (str_starts_with($path, 'admin')) {
            Config::set('session.cookie', $sessionConfig['admin']['cookie']);
            Config::set('session.path', $sessionConfig['admin']['path']);
        } else {
            Config::set('session.cookie', $sessionConfig['customer']['cookie']);
            Config::set('session.path', $sessionConfig['customer']['path']);
        }

        return $next($request);
    }
} 