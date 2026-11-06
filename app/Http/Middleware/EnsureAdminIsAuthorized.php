<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminIsAuthorized
{
    public function handle(Request $request, Closure $next): Response
    {
        $username = config('services.admin.username');
        $password = config('services.admin.password');

        if (!is_string($username) || $username === '' || !is_string($password) || $password === '') {
            if (app()->environment('local')) {
                return $next($request);
            }

            return response('Admin access is not configured.', 503);
        }

        if (!hash_equals($username, (string) $request->getUser())
            || !hash_equals($password, (string) $request->getPassword())) {
            return response('Unauthorized.', 401, [
                'WWW-Authenticate' => 'Basic realm="BaliGuard Admin", charset="UTF-8"',
            ]);
        }

        return $next($request);
    }
}