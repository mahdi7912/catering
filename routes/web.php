<?php

use App\Http\Controllers\api\CompanyController;
use App\Http\Controllers\api\FoodController;
use App\Http\Controllers\api\MealController;
use App\Http\Controllers\api\ReserveController;
use App\Http\Controllers\api\SundryController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\company\CompanyController as CompanyCompanyController;
use App\Http\Controllers\company\ReserveController as CompanyReserveController;
use App\Http\Controllers\company\UserController as CompanyUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\user\CreditController;
use App\Http\Controllers\user\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['guest']], function () {
    Route::inertia('/', 'Auth/Login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'reserve'])->name('reserve');

    Route::post('/credit', [CreditController::class, 'pay']);
    Route::get('/credit/verification', [CreditController::class, 'verification']);
});


// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::inertia('/foods', 'Admin/Food/Index');
    Route::inertia('/sundries', 'Admin/Sundry/Index');
    Route::inertia('/companies', 'Admin/Company/Index');
    Route::inertia('/users', 'Admin/User/Index');
    Route::inertia('/meals', 'Admin/Meal/Index');
    Route::inertia('/reserves', 'Admin/Reserve/Index');
});

// admin api
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::apiResource('food', FoodController::class);
    Route::apiResource('sundry', SundryController::class);
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('meal', MealController::class);
    Route::apiResource('reserve', ReserveController::class);

    Route::post('filter', [FilterController::class, 'filter']);
});




// company Routes
Route::group(['prefix' => 'company', 'as' => 'company.', 'middleware' => ['auth', 'company']], function () {
    Route::inertia('/dashboard', 'Company/Dashboard')->name('dashboard');
    Route::inertia('/users', 'Company/User/Index');
    Route::inertia('/reserves', 'Company/Reserve/Index');
    Route::inertia('/companies', 'Company/Company/Index');
});

// company api
Route::group(['prefix' => 'company', 'middleware' => ['auth', 'company']], function () {
    Route::apiResource('company', CompanyCompanyController::class);
    Route::apiResource('user', CompanyUserController::class);
    Route::get('reserve', [CompanyReserveController::class, 'index']);
    Route::post('filter', [FilterController::class, 'filter']);
});
