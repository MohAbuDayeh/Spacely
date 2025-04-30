<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // تحقق إذا كان المستخدم مسجلاً دخوله
        if (!auth()->check()) {
            return redirect()->route('login'); // إعادة التوجيه إلى صفحة تسجيل الدخول إذا كان المستخدم غير مسجل
        }

        // تحقق من دور المستخدم
        if (auth()->user()->role !== $role) {
            return redirect()->route('home'); // إعادة التوجيه إذا لم يكن لديه الدور المناسب
        }

        return $next($request);
    }
}
