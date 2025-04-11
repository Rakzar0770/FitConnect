<?php

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ActivitiesController::class, 'index'])->name('home');


Route::resource('activities', ActivitiesController::class)->only(['index', 'show']);

Route::prefix('organizations')->group(function () {
    Route::get('/', [OrganizationsController::class, 'show'])->name('organization.index');
    Route::get('/{organization}/branches', [BranchesController::class, 'index'])->name('branches.index');
});





Route::prefix('bookings')->group(function () {
    Route::get('/create/{branch_id}', [BookingsController::class, 'create'])->name('bookings.create.with-branch');
    Route::post('', [BookingsController::class, 'store'])->name('bookings.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UsersController::class, 'dashboard'])->name('users.dashboard');
});


require __DIR__ . '/auth.php';
