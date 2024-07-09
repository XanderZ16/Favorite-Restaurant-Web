<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MatriksController;
use App\Http\Controllers\ProductCommentController;
use App\Models\RestaurantRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/matriks', [MatriksController::class, 'index']);
Route::get('/matrix', [MatriksController::class, 'index2']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/user/{user:name}', [AccountController::class, 'index']);
    Route::get('/user/{user:name}/edit', [AccountController::class, 'edit']);
    Route::put('/user/{user:name}', [AccountController::class, 'update']);
    Route::post('/change-pp', [AccountController::class, 'change_pp']);

    Route::resource('/restaurants', RestaurantController::class);
    Route::post('/restaurants/{restaurant:name}/favorite', [FavoriteController::class, 'favorite']);
    Route::get('/restaurants/{restaurant:name}/products/create', [ProductController::class, 'create']);

    Route::resource('/products', ProductController::class)->except(['create']);
    Route::post('/products/{product}/like', [LikeController::class, 'like']);
    Route::post('/products/{product}/comment', [ProductCommentController::class, 'store']);

    Route::resource('/articles', ArticleController::class)->except(['show']);

    Route::resource('/restaurant-requests', RestaurantRequest::class)->except('index');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/restaurant-requests', [DashboardController::class, 'restaurant_requests']);
});
