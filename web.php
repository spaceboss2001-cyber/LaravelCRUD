<?php

use App\Http\Controllers\DailymenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DishesController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', [DishesController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:owner,admin,cook'])->group(function () {

    Route::get('dishes', [DishesController::class, 'index'])->name('dishes');
    Route::get('edit', [DishesController::class, 'index'])->name('edit');
    Route::get('/gerechten', [DishesController::class, 'viewDishes'])->name('gerechten');
    Route::delete('/dishes/{dish}', [DishesController::class, 'destroy'])->name('dishes.destroy');
    Route::post('/dishes', [DishesController::class, 'store'])->name('dishes.store');
    Route::get('/dishes/{dish}/edit', [DishesController::class, 'edit'])->name('dishes.edit');
    Route::put('/dishes/{dish}', [DishesController::class, 'update'])->name('dishes.update');

    Route::get('dailymenus', [DailymenuController::class, 'index'])->name('dailymenus.index');
    Route::post('dailymenus', [DailymenuController::class, 'store'])->name('dailymenus.store');
    Route::get('/dailymenus/show', [DailymenuController::class, 'show'])->name('dailymenus.show');
    Route::delete('/dailymenus/{dailymenus}', [DailymenuController::class, 'destroy'])->name('dailymenus.destroy');
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