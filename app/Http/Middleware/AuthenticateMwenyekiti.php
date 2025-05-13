<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateMwenyekiti
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('mwenyekiti_id') || !session('mwenyekiti_auth_id')) {
            return redirect()->route('login1');
        }
        return $next($request);
    }
}