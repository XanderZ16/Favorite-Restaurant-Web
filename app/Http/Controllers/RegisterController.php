<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $user_data = $request->validate([
            'full_name' => 'required',
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        $user_data['name'] = strtolower($user_data['name']);
        $user_data['email'] = strtolower($user_data['email']);
        $user_data['password'] = bcrypt($user_data['password']);
        User::create($user_data);
        return redirect('/login');
    }
}
