<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Category\CreateCategory;
use App\Livewire\Category\IndexCategory;
use App\Livewire\Category\UpdateCategory;
use App\Livewire\Employee\CreateEmployee;
use App\Livewire\Employee\IndexEmployee;
use App\Livewire\Employee\UpdateEmployee;
use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\IndexProduct;
use App\Livewire\Product\UpdateProduct;
use App\Livewire\SubCategory\CreateSubCategory;
use App\Livewire\SubCategory\IndexSubCategory;
use App\Livewire\SubCategory\UpdateSubCategory;
use App\Livewire\Supplier\CreateSupplier;
use App\Livewire\Supplier\IndexSupplier;
use App\Livewire\Supplier\UpdateSupplier;
use App\Livewire\Unit\CreateUnit;
use App\Livewire\Unit\IndexUnit;
use App\Livewire\Unit\UpdateUnit;
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
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', IndexCategory::class)->name('index');
        Route::get('/create', CreateCategory::class)->name('create');
        Route::get('/{id}/edit', UpdateCategory::class)->name('edit');
    });
    Route::prefix('subcategory')->name('subcategory.')->group(function () {
        Route::get('/', IndexSubCategory::class)->name('index');
        Route::get('/create', CreateSubCategory::class)->name('create');
        Route::get('/{id}/edit', UpdateSubCategory::class)->name('edit');
    });
    Route::prefix('unit')->name('unit.')->group(function () {
        Route::get('/', IndexUnit::class)->name('index');
        Route::get('/create', CreateUnit::class)->name('create');
        Route::get('/{id}/edit', UpdateUnit::class)->name('edit');
    });
    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/', IndexEmployee::class)->name('index');
        Route::get('/create', CreateEmployee::class)->name('create');
        Route::get('/{id}/edit', UpdateEmployee::class)->name('edit');
    });
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', IndexProduct::class)->name('index');
        Route::get('/create', CreateProduct::class)->name('create');
        Route::get('/{id}/edit', UpdateProduct::class)->name('edit');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
