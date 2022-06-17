<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\MealController;
use App\Http\Controllers\api\ReserveController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\user\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'index'])->name('profiel');

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::inertia('/foods', 'Admin/Food/Index');
    Route::inertia('/categories', 'Admin/Category/Index');
    Route::inertia('/companies', 'Admin/Company/Index');
    Route::inertia('/users', 'Admin/User/Index');
    Route::inertia('/meals', 'Admin/Meal/Index');
    Route::inertia('/reserves', 'Admin/Reserve/Index');
});

// admin api
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::apiResource('food', FoodController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('meal', MealController::class);
    Route::apiResource('reserve', ReserveController::class);

    Route::post('filter', [FilterController::class, 'filter']);
});
