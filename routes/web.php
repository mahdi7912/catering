<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\FilterController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::inertia('/foods', 'Admin/Food/Index');
    Route::inertia('/categories', 'Admin/Category/Index');
    Route::inertia('/companies', 'Admin/Company/Index');
    Route::inertia('/users', 'Admin/User/Index');
});

// admin api
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::apiResource('food', FoodController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('user', UserController::class);

    Route::post('filter', [FilterController::class, 'filter']);
});
