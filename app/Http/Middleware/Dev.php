<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Dev
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if ($request->user()->isDev()) {
                return $next($request);
            } else {
                return redirect('/cek-login');
            }
        } else {
            return redirect('/cek-login');
        }
    }
}
