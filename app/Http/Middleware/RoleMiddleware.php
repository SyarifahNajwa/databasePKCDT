<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware('role:admin') or ->middleware('role:admin,staff')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        if (empty($roles)) {
            return $next($request);
        }

        if (! in_array($user->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
