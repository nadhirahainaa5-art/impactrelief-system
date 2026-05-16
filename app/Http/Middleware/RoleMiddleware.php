<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403, 'Unauthorized.');
        }

        if (!isset($user->role) || !$user->role) {
            abort(403, 'User role not assigned.');
        }

        $userRole = strtolower(trim($user->role));
        $allowedRoles = array_map(fn ($role) => strtolower(trim($role)), $roles);

        if (!in_array($userRole, $allowedRoles, true)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}