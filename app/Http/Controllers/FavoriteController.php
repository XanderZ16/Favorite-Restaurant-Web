<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(Restaurant $restaurant)
    {
        $user = User::find(Auth::id());

        if (!$user->hasFavored($restaurant)) {
            Favorite::firstOrCreate([
                'user_id' => Auth::id(),
                'restaurant_id' => $restaurant->id,
            ]);
        } else {
            $like = Favorite::where('user_id', Auth::id())
                ->where('restaurant_id', $restaurant->id)
                ->first();

            if ($like) {
                $like->delete();
            }
        }

        return back()->with('user', $user);
    }
}
