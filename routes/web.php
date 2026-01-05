<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\CreateAdmin;
use App\Livewire\Admin\IndexAdmin;
use App\Livewire\Admin\UpdateAdmin;
use App\Livewire\Category\CreateCategory;
use App\Livewire\Category\IndexCategory;
use App\Livewire\Category\UpdateCategory;
use App\Livewire\Customer\CreateCustomer;
use App\Livewire\Customer\IndexCustomer;
use App\Livewire\Customer\UpdateCustomer;
// use App\Livewire\Dashboard;
use App\Livewire\Employee\CreateEmployee;
use App\Livewire\Employee\IndexEmployee;
use App\Livewire\Employee\UpdateEmployee;
use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\IndexProduct;
use App\Livewire\Product\UpdateProduct;
use App\Livewire\Purchase\CreatePurchase;
use App\Livewire\Purchase\DetailPurchase;
use App\Livewire\Purchase\IndexPurchase;
use App\Livewire\Purchase\UpdatePurchase;
use App\Livewire\Roles\ManagePermissions;
use App\Livewire\Setting\MenuManagement;
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
// Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');
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
    Route::prefix('purchase')->name('purchase.')->group(function () {
        Route::get('/', IndexPurchase::class)->name('index');
        Route::get('/create', CreatePurchase::class)->name('create');
        Route::get('/{id}/edit', UpdatePurchase::class)->name('edit');
        Route::get('/{id}/detail', DetailPurchase::class)->name('detail');
    });

     Route::prefix('admin-management')->group(function () {
        Route::get('/', IndexAdmin::class)->name('admin.index');
        Route::get('/create', CreateAdmin::class)->name('admin.create');
        Route::get('/{id}/edit', UpdateAdmin::class)->name('admin.edit');
    });
     Route::prefix('customer')->group(function () {
        Route::get('/', IndexCustomer::class)->name('customer.index');
        Route::get('/create', CreateCustomer::class)->name('customer.create');
        Route::get('/{id}/edit', UpdateCustomer::class)->name('customer.edit');
    });
    Route::get('/roles/manage-permissions', ManagePermissions::class)
        ->name('roles.manage-permissions');
    Route::get('/setting/manage-menu', MenuManagement::class)
        ->name('setting.manage-menu');
    Route::get('/setting/role-management', \App\Livewire\Setting\RoleManagement::class)
        ->name('setting.role-management');
    Route::get('/setting/permission-management', \App\Livewire\Setting\PermissionManagement::class)
        ->name('setting.permission-management');
    Route::get('/setting/user-role-management', \App\Livewire\Setting\UserRoleManagement::class)
        ->name('setting.user-role-management');
    Route::get('/setting/role-permission-management', \App\Livewire\Setting\RolePermissionManagement::class)
        ->name('setting.role-permission-management');
        
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
