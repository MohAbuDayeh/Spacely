<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // إذا لم يكن مسجلاً دخوله
        if (!Auth::check()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthenticated'], 401)
                : redirect()->route('auth.login');
        }

        $user = Auth::user();

        // إذا لم يكن لديه أي من الأدوار المطلوبة
        if (!in_array($user->role, $roles)) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Forbidden'], 403)
                : redirect()->route('home')->with('error', 'You do not have access to this section');
        }

        return $next($request);
    }
}
