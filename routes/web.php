<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [ActivityController::class, 'index'])->name('home');

// Список занятий
Route::resource('activities', ActivityController::class)->only(['index', 'show']);

// Список организаций по виду занятий
Route::get('/activities/{activity}/organizations', [OrganizationController::class, 'index'])->name('organizations.index');

// Список филиалов организации
Route::get('/organizations/{organization}/branches', [BranchController::class, 'index'])->name('branches.index');
Route::get('/bookings/create/{branch_id}', [BookingController::class, 'create'])
    ->name('bookings.create.with-branch');
// Страница записи с предварительным выбором филиала
Route::get('/bookings/create/{branch_id}', [BookingController::class, 'create'])->name('bookings.create.with-branch');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
// Страница записи
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Личный кабинет пользователя
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
});

// Загрузка маршрутов аутентификации
require __DIR__.'/auth.php';
