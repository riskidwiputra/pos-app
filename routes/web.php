<?php

use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProfileAdminsController;
use App\Livewire\Cashier\Kasir;
use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\CreateAdmin;
use App\Livewire\Admin\IndexAdmin;
use App\Livewire\Admin\UpdateAdmin;
use App\Livewire\Auth\CustomerRegister;
use App\Livewire\Auth\ManageRolePermissions;
use App\Livewire\Category\CreateCategory;
use App\Livewire\Category\IndexCategory;
use App\Livewire\Category\UpdateCategory;
use App\Livewire\Customer\CreateCustomer;
use App\Livewire\Customer\IndexCustomer;
use App\Livewire\Customer\UpdateCustomer;
use App\Livewire\Dashboard;
use App\Livewire\Employee\CreateEmployee;
use App\Livewire\Employee\IndexEmployee;
use App\Livewire\Employee\UpdateEmployee;
use App\Livewire\Laporan\LaporanPenjualanPerItem;
use App\Livewire\Laporan\LaporanPenjualanTransaksi;
use App\Livewire\Laporan\LaporanStok;
use App\Livewire\OrderJasa\CreateOrderCustomer;
use App\Livewire\OrderJasa\CreateOrderJasa;
use App\Livewire\OrderJasa\DetailOrderCustomer;
use App\Livewire\OrderJasa\DetailOrderJasa;
use App\Livewire\OrderJasa\IndexOrderCustomer;
use App\Livewire\OrderJasa\IndexOrderJasa;
use App\Livewire\OrderJasa\ServiceCategoryJasa;
use App\Livewire\OrderJasa\UpdateOrderCustomer;
use App\Livewire\OrderJasa\UpdateOrderJasa;
use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\IndexProduct;
use App\Livewire\Product\MassUpload;
use App\Livewire\Product\UpdateProduct;
use App\Livewire\Purchase\CreatePurchase;
use App\Livewire\Purchase\DetailPurchase;
use App\Livewire\Purchase\IndexPurchase;
use App\Livewire\Purchase\updatePurchase;
use App\Livewire\Roles\ManagePermissions;
use App\Livewire\Sale\CreateSale;
use App\Livewire\Sale\DetailSale;


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
use App\Livewire\Sale\IndexSale;
use App\Livewire\Print\PrintNota;
use App\Livewire\Sale\updateSale;
use App\Livewire\Setting\RoleManagement;

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
    return view('livewire.home.index');
});

Route::get('/login', function () {
    return view('auth.loginUser');
})->name('login');

Route::get('/register', CustomerRegister::class)->name('register');


Route::middleware('customer')->group(function () {
        
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        
    Route::prefix('order-jasa')->name('order-jasa.')->group(function () {
        
        Route::get('/riwayat-pesanan', IndexOrderCustomer::class)
            ->name('riwayat-pesanan');

        Route::get('/tambah-pesanan', CreateOrderCustomer::class)
            ->name('tambah-pesanan');
        
        Route::get('/{id}/detail-pesanan', DetailOrderCustomer::class)
            ->name('detail-pesanan');

        Route::get('/{id}/ubah-pesanan', UpdateOrderCustomer::class)
        ->name('ubah-pesanan');

                    
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
      
});
Route::prefix('sb-admin')->middleware('auth')->group(function () {

  
    Route::get('/cashier', [KasirController::class, 'index'])
        ->name('cashier');
    
    Route::get('/profile', [ProfileAdminsController::class, 'edit'])->name('profile-admin.edit');
    Route::patch('/profile', [ProfileAdminsController::class, 'update'])->name('profile-admin.update');
    Route::put('/profile/password', [ProfileAdminsController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileAdminsController::class, 'destroy'])->name('profile-admin.destroy');
    
    Route::get('/cashier/product/{id}', [KasirController::class, 'getProduct']);
    
    Route::post('/cashier/process', [KasirController::class, 'prosesPembayaran']);



    Route::get('/dashboard', Dashboard::class)->name('dashboard-admin');
    
    // Route::get('/cashier', Kasir::class)->name('cashier');

    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/', IndexSupplier::class)->name('index')->middleware('permission:supplier.view');
        Route::get('/create', CreateSupplier::class)->name('create')->middleware('permission:supplier.create');
        Route::get('/{id}/edit', UpdateSupplier::class)->name('edit')->middleware('permission:supplier.edit');
    });

    Route::prefix('category')->middleware('permission:category.manage')->name('category.')->group(function () {
        Route::get('/', IndexCategory::class)->name('index');
        Route::get('/create', CreateCategory::class)->name('create');
        Route::get('/{id}/edit', UpdateCategory::class)->name('edit');
    });

    Route::prefix('subcategory')->middleware('permission:subcategory.manage')->name('subcategory.')->group(function () {
        Route::get('/', IndexSubCategory::class)->name('index');
        Route::get('/create', CreateSubCategory::class)->name('create');
        Route::get('/{id}/edit', UpdateSubCategory::class)->name('edit');
    });

    Route::prefix('unit')->middleware('permission:unit.manage')->name('unit.')->group(function () {
        Route::get('/', IndexUnit::class)->name('index');
        Route::get('/create', CreateUnit::class)->name('create');
        Route::get('/{id}/edit', UpdateUnit::class)->name('edit');
    });

    Route::prefix('karyawan')->middleware('permission:karyawan.manage')->name('karyawan.')->group(function () {
        Route::get('/', IndexEmployee::class)->name('index');
        Route::get('/create', CreateEmployee::class)->name('create');
        Route::get('/{id}/edit', UpdateEmployee::class)->name('edit');
    });

    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', IndexProduct::class)
        ->middleware('permission:product.view')
        ->name('index');

        Route::get('/create', CreateProduct::class)
            ->middleware('permission:product.create')
            ->name('create');

        Route::get('/{id}/edit', UpdateProduct::class)
            ->middleware('permission:product.edit')
            ->name('edit');

        Route::get('/mass-upload', MassUpload::class)
            ->middleware('permission:product.create')
            ->name('mass-upload');
    });

    Route::prefix('purchase')->middleware('permission:purchase.view')->name('purchase.')->group(function () {
        Route::get('/', IndexPurchase::class)->name('index');

        Route::get('/create', CreatePurchase::class)
            ->middleware('permission:purchase.create')
            ->name('create');

        Route::get('/{id}/edit', UpdatePurchase::class)
            ->middleware('permission:purchase.edit')
            ->name('edit');

        Route::get('/{id}/detail', DetailPurchase::class)
            ->name('detail');
    });
    Route::prefix('sale')->middleware('permission:sale')->name('sale.')->group(function () {
          Route::get('/', IndexSale::class)
          ->middleware('permission:sale.view')
          ->name('index');

        Route::get('/create', CreateSale::class)
            ->middleware('permission:sale.create')
            ->name('create');

        Route::get('/{id}/update', UpdateSale::class)
            ->middleware('permission:sale.edit')
            ->name('update');

        Route::get('/{id}/detail', DetailSale::class)->name('detail');
    });
    Route::prefix('admin-management')->middleware('permission:admin-management.manage')->group(function () {
        Route::get('/', IndexAdmin::class)->name('admin.index');
        Route::get('/create', CreateAdmin::class)->name('admin.create');
        Route::get('/{id}/edit', UpdateAdmin::class)->name('admin.edit');
    });
    Route::prefix('customer')->middleware('permission:customer.manage')->group(function () {
        Route::get('/', IndexCustomer::class)->name('customer.index');
        Route::get('/create', CreateCustomer::class)->name('customer.create');
        Route::get('/{id}/edit', UpdateCustomer::class)->name('customer.edit');
    });
    Route::prefix('laporan')->name('laporan.')->group(function () {
        // Penjualan
        Route::get('/penjualan/transaksi', LaporanPenjualanTransaksi::class)
        ->middleware('permission:laporan.transaksi')
            ->name('penjualan.transaksi');
        
        Route::get('/penjualan/per-item', LaporanPenjualanPerItem::class)
        ->middleware('permission:laporan.per-item')
            ->name('penjualan.per-item');
        
       Route::get('/stok', LaporanStok::class)
        ->middleware('permission:laporan.stok')
            ->name('stok');

       
    });
    Route::prefix('order-jasa')->name('order-jasa.')->group(function () {
             Route::get('/', IndexOrderJasa::class)->name('index');

        Route::get('/create', CreateOrderJasa::class)
            ->middleware('permission:order-jasa.create')
            ->name('create');

        Route::get('/create-order', CreateOrderCustomer::class)
            ->name('create-order');
        Route::get('/getOrder', IndexOrderCustomer::class)
            ->name('getOrder');
        Route::get('/{id}/getDetail', DetailOrderCustomer::class)
            ->name('getDetail');

        Route::get('/{id}/update', UpdateOrderJasa::class)
            ->middleware('permission:order-jasa.edit')
            ->name('update');
        Route::get('/{id}/getUpdate', UpdateOrderCustomer::class)->name('getUpdate');

        Route::get('/{id}/detail', DetailOrderJasa::class)->name('detail');

            Route::get('/setting-kategori', ServiceCategoryJasa::class)->name('setting-kategori');
                    
    });
    Route::prefix('print')->name('print.')->group(function () {
        Route::get('/nota/{sale}', PrintNota::class)->name('nota');
        
    });
    Route::get('/nota/{sale}', function($id) {
            $sale = \App\Models\Sale::with(['items.product'])->findOrFail($id);
            return view('livewire.print.print-nota', compact('sale'));
        });
    Route::prefix('auth')->name('auth.')->middleware('permission:permission')->group(function () {
        Route::get('/permissions', ManageRolePermissions::class)->name('permissions');
        Route::get('/role-management', RoleManagement::class)
        ->name('role-management');
    });
    Route::get('/invoice/{sale}', function($id) {
            $sale = \App\Models\Sale::with(['items.product', 'users'])->findOrFail($id);
            return view('livewire.print.invoice', compact('sale'));
        });
    Route::get('/laporan-penjualan-transaksi/{sale}', function($id) {
            $sale = \App\Models\Sale::with(['items.product', 'users'])->findOrFail($id);
            return view('livewire.print.laporan-penjualan-transaksi', compact('sale'));
         })->name('laporan-penjualan-transaksi.detail');
    
   
});

require __DIR__.'/auth.php';
