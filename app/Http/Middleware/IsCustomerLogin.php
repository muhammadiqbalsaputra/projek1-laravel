<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsCustomerLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah ada customer yang sudah login (misalnya, session aktif)
        if (auth()->guard('customer')->check()) {
            return $next($request);
        }
        return redirect()->route('customer.login');
    }
}
