<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class);
    }

    public function likes_count()
    {
        return $this->hasMany(Like::class)->count();
    }
}
