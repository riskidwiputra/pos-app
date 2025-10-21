<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Supplier\CreateSupplier;
use App\Livewire\Supplier\IndexSupplier;
use App\Livewire\Supplier\UpdateSupplier;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/', IndexSupplier::class)->name('index');
        Route::get('/create', CreateSupplier::class)->name('create');
        Route::get('/{id}/edit', UpdateSupplier::class)->name('edit');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
