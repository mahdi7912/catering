<?php

use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\MealController;
use App\Http\Controllers\api\ReserveController;
use App\Http\Controllers\api\SundryController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\user\CreditController;
use App\Http\Controllers\user\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'reserve'])->name('reserve');

Route::post('/credit', [CreditController::class, 'pay']);
Route::get('/credit/verification', [CreditController::class, 'verification']);

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::inertia('/foods', 'Admin/Food/Index');
    Route::inertia('/sundries', 'Admin/Sundry/Index');
    Route::inertia('/companies', 'Admin/Company/Index');
    Route::inertia('/users', 'Admin/User/Index');
    Route::inertia('/meals', 'Admin/Meal/Index');
    Route::inertia('/reserves', 'Admin/Reserve/Index');
});

// admin api
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::apiResource('food', FoodController::class);
    Route::apiResource('sundry', SundryController::class);
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('meal', MealController::class);
    Route::apiResource('reserve', ReserveController::class);

    Route::post('filter', [FilterController::class, 'filter']);
});




// company Routes
Route::group(['prefix' => 'company', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::inertia('/users', 'Admin/User/Index');
    Route::inertia('/reserves', 'Admin/Reserve/Index');
});

// company api
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::apiResource('food', FoodController::class);
    Route::apiResource('sundry', SundryController::class);
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('meal', MealController::class);
    Route::apiResource('reserve', ReserveController::class);

    Route::post('filter', [FilterController::class, 'filter']);
});
