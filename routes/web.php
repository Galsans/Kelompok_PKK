<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UserReservation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('landing');
// });

Route::get('/', [RoomsController::class, 'landing']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile2.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile2.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('layout.dashboard');
    })->name('dashboard');

    // PROFILE
    Route::get('profile', [ProfileController::class, 'edit2'])->name('profile.edit');
    Route::put('profile-update', [ProfileController::class, 'update2'])->name('profile.update');

    Route::prefix('admin')->middleware('admin')->group(function () {
        // ROOMS
        Route::get('rooms', [RoomsController::class, 'index'])->name('rooms.index');
        Route::get('rooms-create', [RoomsController::class, 'create'])->name('rooms.create');
        Route::post('rooms-store', [RoomsController::class, 'store'])->name('rooms.store');
        Route::get('rooms-show/{id}', [RoomsController::class, 'show'])->name('rooms.show');
        Route::get('rooms-edit/{id}', [RoomsController::class, 'edit'])->name('rooms.edit');
        Route::put('rooms-update/{id}', [RoomsController::class, 'update'])->name('rooms.update');
        Route::delete('rooms-destroy/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy');

        // RESERVATION
        Route::get('reservation', [ReservationController::class, 'index'])->name('reservation.index');
        Route::get('reservation-create/{id}', [ReservationController::class, 'create'])->name('reservation.create');
        Route::get('reservation-create2', [ReservationController::class, 'createWithoutId'])->name('reservation.create2');
        Route::post('reservation-store', [ReservationController::class, 'store'])->name('reservation.store');
        Route::get('reservation-show/{id}', [ReservationController::class, 'show'])->name('reservation.show');
        Route::get('reservation-edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
        Route::put('reservation-update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
        Route::delete('reservation-destroy/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

        Route::put('reservation/{id}', [ReservationController::class, 'confirmReservation'])->name('reservation.confirm');
    });

    Route::prefix('user')->middleware('user')->group(function () {
        Route::get('reservation', [UserReservation::class, 'index'])->name('userReservation.index');
        Route::get('reservation-create', [UserReservation::class, 'create'])->name('userReservation.create');
        Route::post('reservation-store', [UserReservation::class, 'store'])->name('userReservation.store');
        Route::delete('reservation-delete/{id}', [UserReservation::class, 'destroy'])->name('userReservation.destroy');
    });
});
