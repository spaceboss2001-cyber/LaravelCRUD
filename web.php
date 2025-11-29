<?php

use App\Http\Controllers\CarpartsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CarsController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', [CarsController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:owner,admin,cook'])->group(function () {

    Route::get('cars', [CarsController::class, 'index'])->name('cars');
    Route::get('edit', [CarsController::class, 'index'])->name('edit');
    Route::get('/cars/view', [CarsController::class, 'viewCars'])->name('cars.view');

    Route::delete('/cars/{car}', [CarsController::class, 'destroy'])->name('cars.destroy');
    Route::post('/cars', [CarsController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarsController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarsController::class, 'update'])->name('cars.update');

    Route::get('carparts', [CarpartsController::class, 'index'])->name('carparts.index');
    Route::post('carparts', [CarpartsController::class, 'store'])->name('carparts.store');
    Route::get('/carparts/show', [CarpartsController::class, 'show'])->name('carparts.show');
    Route::delete('/carparts/{carparts}', [CarpartsController::class, 'destroy'])->name('carparts.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('reservation', [ReservationController::class, 'index'])->name('reservation');
});

Route::middleware(['auth', 'role:owner,admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    Route::get('settings/two-factor', TwoFactor::class)->middleware(['password.confirm'])->name('two-factor.show');
});
