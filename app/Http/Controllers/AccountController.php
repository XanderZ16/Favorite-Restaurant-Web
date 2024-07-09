<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(User $user)
    {
        $self = Auth::id() === $user->id;
        $full_name = $user->full_name;
        $name = $user->name;
        $email = $user->email;
        $profile_photo = $user->profile_photo;
        $article = $user->article;
        $restaurants = $user->restaurants;
        return view('account.index', compact('self', 'full_name', 'name', 'email', 'profile_photo', 'article', 'restaurants'));
    }

    public function favorites(User $user){
        $self = Auth::id() === $user->id;
        $full_name = $user->full_name;
        $name = $user->name;
        $email = $user->email;
        $profile_photo = $user->profile_photo;
        $favorites_restaurant = $user->favorites_restaurant();
        return view('account.favorites', compact('self', 'full_name', 'name', 'email', 'profile_photo', 'favorites_restaurant'));
    }

    public function edit(User $user)
    {
        if (Auth::id() != $user->id) {
            abort(403);
        }
        $full_name = Auth::user()->full_name;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        return view('account.edit', compact('full_name', 'name', 'email'));
    }

    public function update(Request $request, User $user)
    {
        $user_data = $request->validate([
            'full_name' => 'required',
            'name' => 'required',
            'email' => 'required|email:dns',
        ]);
        $user_data['name'] = strtolower($user_data['name']);
        $user_data['email'] = strtolower($user_data['email']);
        $user->update($user_data);
        return redirect('/user/' . $user_data['name']);
    }

    // change pp
    public function change_pp(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('profile_pics', 'public');

        $user = User::find(Auth::user()->id);
        $user->update(['profile_photo' => $path]);
    }
}
