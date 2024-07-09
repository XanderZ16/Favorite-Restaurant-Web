<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return "name";
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function products_count()
    {
        return $this->products->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites_count()
    {
        return $this->hasMany(Favorite::class)->count();
    }

    public function threeTopProducts()
    {
        return $this->products()->orderBy('likes_count', 'desc')->take(3)->get();
    }
}
