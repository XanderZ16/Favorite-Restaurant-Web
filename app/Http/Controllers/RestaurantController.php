<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|max:100|unique:restaurants,name',
            'description' => 'required|max:1000',
            'image' => 'required|image|max:2048',
            'website' => 'url',
            'address' => 'required',
            'city' => 'required',
            'email' => 'required|email:dns',
            'phone' => 'numeric',
        ]);

        $validated_data['image'] = $request->file('image')->store('restaurant_pics', 'public');
        $validated_data['user_id'] = Auth::id();

        Restaurant::create($validated_data);
        return redirect('/restaurants');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $mine = $restaurant->user_id == Auth::id();
        $products = $restaurant->products;
        $threeTopProducts = $restaurant->threeTopProducts();
        return view('restaurants.show', compact('restaurant', 'products', 'mine', 'threeTopProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        if ($restaurant->user_id != Auth::id()) {
            return redirect ('/restaurants/create');
        }
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated_data = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'image' => 'image|max:2048',
            'website' => 'url',
            'address' => 'required',
            'city' => 'required',
            'email' => 'required|email:dns',
            'phone' => 'numeric',
        ]);

        if ($request->hasFile('image')) {
            $validated_data['image'] = $request->file('image')->store('photos', 'public');
        } else {
            $validated_data['image'] = $restaurant->image;
        }

        $restaurant->update($validated_data);
        return redirect('/restaurants' . $restaurant->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->user_id != Auth::id()) {
            abort(403);
        }
        $restaurant->delete();
        return redirect('/restaurants');
    }
}
