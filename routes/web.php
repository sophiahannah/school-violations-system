<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SanctionController;
use App\Http\Controllers\Admin\ViolationController;
use App\Http\Controllers\Admin\ViolationsManagementController;
use App\Http\Controllers\Student\AppealController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ViolationOverviewController;
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

        // Violations Management Page
        Route::get('/violations-management', [ViolationsManagementController::class, 'index'])->name('admin.violations-management.index');

        //Sanction Page
        Route::get('/sanction', [SanctionController::class, 'index'])->name('admin.sanction');

        //Post - Log Violation
        // Route::get('/violation', [ViolationController::class, ''])
    });

    // Student Routes
    Route::group(['middleware' => 'Role:student', 'prefix' => 'student'], function () {

        // User Dashboard Page
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard.index');

        // Violation Overview Page
        Route::get('/violation-overview', [ViolationOverviewController::class, 'index'])->name('student.violation.overview');

        // Post Appeal
        Route::post('/appeal', [AppealController::class, 'store'])->name('appeal.store');
    });



    //Logout user
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
