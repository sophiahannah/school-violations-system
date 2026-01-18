<?php

use App\Http\Controllers\Admin\AppealController as AdminAppealController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SanctionController;
use App\Http\Controllers\Admin\ViolationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\AppealController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\FaqController;
use App\Http\Controllers\Student\HandbookController;
use App\Http\Controllers\Student\ViolationOverviewController;
use App\Mail\ViolationRecordedMail;
use App\Models\ViolationRecord;
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
    Route::group(['middleware' => 'Role:faculty', 'prefix' => 'admin', 'as' => 'admin.'], function () {

        // Dashboard Page
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

        // Sanction Page
        Route::get('/sanction', [SanctionController::class, 'index'])->name('sanction');

        // Appeals Management Page
        Route::get('/appeals', [AdminAppealController::class, 'index'])->name('appeals.index');
        Route::post('/appeals/{appeal}/approve', [AdminAppealController::class, 'approve'])->name('appeals.approve');
        Route::post('/appeals/{appeal}/reject', [AdminAppealController::class, 'reject'])->name('appeals.reject');

        // Violation Resource
        Route::resource('/violations-management', ViolationController::class);

        // Resolve Violation
        Route::post('/violations-management/{violations_management}/resolve', [ViolationController::class, 'resolve'])
            ->name('violations-management.resolve');
    });

    // Student Routes
    Route::group(['middleware' => 'Role:student', 'prefix' => 'student'], function () {

        // User Dashboard Page
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard.index');

        // Violation Overview Page
        Route::get('/violation-overview', [ViolationOverviewController::class, 'index'])->name('student.violation.overview');

        // Post Appeal
        Route::post('/appeal', [AppealController::class, 'store'])->name('appeal.store');

        // FAQs Page
        Route::get('/faqs', [FaqController::class, 'index'])->name('student.faqs.index');

        // Handbook Page
        Route::get('/handbook', [HandbookController::class, 'index'])->name('student.handbook.index');
    });

    // Logout user
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
