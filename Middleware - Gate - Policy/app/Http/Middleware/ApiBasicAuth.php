<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiBasicAuth
{
    /**
     * HTTP Basic Auth stateless (tanpa session) buat endpoint API.
     * Login pakai kolom 'username' + password.
     */
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::onceBasic('username') ?: $next($request);
    }
}
