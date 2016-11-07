<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class Client
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Config::set('jwt.user', '\Domain\Client\Client');
        Config::set('auth.providers.users.model', '\Domain\Client\Client');

        return $next($request);
    }
}
