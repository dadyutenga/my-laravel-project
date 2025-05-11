<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateBalozi
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('balozi_id') || !session('balozi_auth_id')) {
            return redirect()->route('balozi.login');
        }
        return $next($request);
    }
}