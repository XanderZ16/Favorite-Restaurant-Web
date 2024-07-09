<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        $name = Cookie::get('login_name');
        $password = Cookie::get('login_password');
        $remember = $name && $password;
        return view('auth.login', compact('name', 'password', 'remember'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            if ($remember) {
                Cookie::queue('login_name', $request->name, 10080);
                Cookie::queue('login_password', $request->password, 10080);
            } else {
                Cookie::queue(Cookie::forget('login_name'));
                Cookie::queue(Cookie::forget('login_password'));
            }
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        $user_exist = User::where('name', $request->name)->exists();

        if (!$user_exist) {
            return back()->withInput()->withErrors(['nameError' => 'Username tidak terdaftar']);
        }

        return back()->withInput()->withErrors(['passwordError' => 'Password salah']);
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
