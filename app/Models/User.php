<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function hasFavored(Restaurant $restaurant)
    {
        return $this->favorites()->where('restaurant_id', $restaurant->id)->exists();
    }

    public function favorites_restaurant()
    {
        $favorites = $this->favorites;
        $favorite_ids = $favorites->pluck('restaurant_id')->toArray();
        return Restaurant::whereIn('id', $favorite_ids)->get();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function hasLiked(Product $product)
    {
        return $this->likes()->where('product_id', $product->id)->exists();
    }

    public function article()
    {
        return $this->hasOne(Article::class);
    }
}
