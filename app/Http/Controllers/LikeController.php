<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Product $product) {
        $user = User::find(Auth::id());

        if (!$user->hasLiked($product)) {
            Like::firstOrCreate([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
        } else {
            $like = Like::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($like) {
                $like->delete();
            }
        }

        return back()->with('user', $user);
    }
}
