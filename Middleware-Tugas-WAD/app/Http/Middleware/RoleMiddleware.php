<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var User|null $user */
$user = Auth::user();

        if (!$user || !$user->hasRole(...$roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}