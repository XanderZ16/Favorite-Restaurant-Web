<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated_data = $request->validate([
            'comment' => 'required|max:1000',
        ]);
        $validated_data['user_id'] = Auth::id();
        $validated_data['product_id'] = $product->id;

        ProductComment::create($validated_data);
        return back();
    }

    public function delete(ProductComment $productComment)
    {
        $productComment->delete();
        return back();
    }
}
