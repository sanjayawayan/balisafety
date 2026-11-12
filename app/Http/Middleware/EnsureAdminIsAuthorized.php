<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminIsAuthorized
{
    public function handle(Request $request, Closure $next): Response
    {
        $username = config('services.admin.username', 'admin');
        $password = config('services.admin.password', 'baliguard2026');

        if (!is_string($username) || $username === '' || !is_string($password) || $password === '') {
            $username = 'admin';
            $password = 'baliguard2026';
        }

        // 1. Check web session authentication
        if ($request->session()->has('admin_logged_in') && $request->session()->get('admin_logged_in') === true) {
            return $next($request);
        }

        // 2. Check HTTP Basic Auth credentials (supports both PHP_AUTH and Authorization header)
        $authUser = $request->getUser();
        $authPass = $request->getPassword();

        if (!$authUser && $request->headers->has('Authorization')) {
            $header = (string) $request->header('Authorization');
            if (str_starts_with($header, 'Basic ')) {
                $decoded = base64_decode(substr($header, 6));
                $parts = explode(':', $decoded, 2);
                if (count($parts) === 2) {
                    $authUser = $parts[0];
                    $authPass = $parts[1];
                }
            }
        }

        if ($authUser !== null && hash_equals($username, (string) $authUser) && hash_equals($password, (string) $authPass)) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_user', $username);
            return $next($request);
        }

        // 3. For local development ease, allow bypass only if explicitly enabled
        if (app()->environment('local') && env('ADMIN_BYPASS_LOCAL', false)) {
            return $next($request);
        }

        // 4. API or AJAX requests get 401 Unauthorized
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        // 5. Browser requests redirect to the Admin Login page
        return redirect()->route('admin.login')->with('warning', 'Silakan masuk untuk mengakses Pusat Komando BaliGuard.');
    }
}
