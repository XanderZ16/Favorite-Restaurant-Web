<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Restaurant $restaurant)
    {
        if ($restaurant->user_id != Auth::id()) {
            return abort(403);
        }
        $restaurant_id = $restaurant->id;
        return view('products.create', compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant_id);
        if ($restaurant->user_id != Auth::id()) {
            return abort(403);
        }

        $validated_data = $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'description' => 'required|max:1000',
            'image' => 'required|image|max:2048',
            'restaurant_id' => 'required',
        ]);
        $validated_data['image'] = $request->file('image')->store('product_pics', 'public');

        Product::create($validated_data);
        return redirect('/restaurants/' . $restaurant->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $mine = $product->restaurant->user_id == Auth::id();
        $comments = $product->comments;
        return view('products.show', compact('product', 'mine', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $restaurant = Restaurant::find($product->restaurant_id);
        if ($restaurant->user_id != Auth::id()) {
            return abort(403);
        }

        $validated_data = $request->validate([
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'description' => 'required|max:1000',
        ]);
        if ($request->hasFile('image')) {
            $validated_data['image'] = $request->file('image')->store('product_pics', 'public');
        }
        $product->update($validated_data);
        return redirect('/products/' . $product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $restaurant = Restaurant::find($product->restaurant_id);
        if ($restaurant->user_id != Auth::id()) {
            return abort(403);
        }

        $product->delete();
        return redirect('/restaurants/' . $restaurant->name);
    }
}
