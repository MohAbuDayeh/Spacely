<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // بعد تسجيل الدخول بنجاح، التحقق من الدور
            $user = Auth::user();

            // التوجيه بناءً على الدور
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'lessor') {
                return redirect()->route('lessor.dashboard');
            } elseif ($user->role == 'renter') {
                return redirect()->route('renter.dashboard');
            }

            // إذا لم يكن لديه أي دور، يمكن توجيههم إلى الصفحة الرئيسية أو صفحة خطأ
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
