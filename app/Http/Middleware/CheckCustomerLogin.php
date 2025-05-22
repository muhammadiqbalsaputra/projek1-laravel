<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomerLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah ada customer yang sudah login (misalnya, session aktif)
        if (auth()->guard('customer')->check()) {
            return redirect()->route('home'); // Redirect ke halaman home atau profile customer
        }
        return $next($request); // Jika sudah login, lanjutkan ke route berikutnya
    }
}
