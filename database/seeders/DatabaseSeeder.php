<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
        ]);

        User::create([
            'full_name' => 'Alfredo Alexander Mendez',
            'name' => 'xander',
            'email' => 'alfredoalexandermendez16@gmail.com',
            'password' => bcrypt('12345678'),
            'profile_photo' => 'profile_pics/profile.jpeg',
        ]);

        User::factory(4)->create();
        Restaurant::factory(20)->create();
        Product::factory(100)->create();
    }
}
