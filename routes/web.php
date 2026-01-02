<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Default Route
Route::get('/', function () {
    return redirect()->route('show.login');
})->middleware('RedirectIfAuth');

// Guest Routes
Route::group(['middleware' => 'guest'], function () {

    // Login Form
    Route::get('/login', action: [AuthController::class, 'showLogin'])->name('show.login');

    // Post Login Form
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


// Authenticated Routes
Route::group(['middleware' => 'auth'], function () {

    // Admin / Faculty Routes
    Route::group(['middleware' => 'Role:faculty', 'prefix' => 'admin'], function () {

        // Dashboard Page
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');
    });

    // Student Routes
    Route::group(['middleware' => 'Role:student', 'prefix' => 'student'], function () {

        // User Dashboard Page
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard.index');
    });

    //Logout user
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
