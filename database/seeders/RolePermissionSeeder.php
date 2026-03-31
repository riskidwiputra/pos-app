<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // ========================================
        // BUAT ROLES
        // ========================================
        
        $superAdmin = Role::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'description' => 'Akses penuh ke seluruh sistem',
            'level' => 0,
            'is_active' => true,
        ]);

        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator toko',
            'level' => 1,
            'is_active' => true,
        ]);

      

        $customer = Role::create([
            'name' => 'Customer',
            'slug' => 'customer',
            'description' => 'Pelanggan',
            'level' => 2,
            'is_active' => true,
        ]);

        $menus = [

            ['name'=>'Dashboard', 'module'=>'dashboard', 'slug'=>'dashboard'],

            ['name'=>'Kasir','module'=>'kasir', 'slug'=>'kasir'],

            ['name'=>'Supplier','module'=>'supplier', 'slug'=>'supplier'],
            ['name'=>'Produk','module'=>'product', 'slug'=>'product'],

            ['name'=>'Pembelian','module'=>'purchase', 'slug'=>'purchase'],

            ['name'=>'Penjualan','module'=>'sale', 'slug'=>'sale'],

            ['name'=>'Permission','module'=>'permission', 'slug'=>'permission'],

            ['name'=>'Order Jasa','module'=>'order-jasa', 'slug'=>'order-jasa'],

            ['name'=>'Data User','module'=>'user', 'slug'=>'user-management'],

            ['name'=>'Category','module'=>'category', 'slug'=>'category'],

            ['name'=>'SubCategory','module'=>'subcategory', 'slug'=>'subcategory'],

            ['name'=>'Unit','module'=>'unit', 'slug'=>'unit'],

            ['name'=>'Laporan','module'=>'laporan', 'slug'=>'laporan']

        ];

        foreach ($menus as $menu) {

            Permission::create([
                'name'=>$menu['name'],
                'slug'=>$menu['slug'],
                'module'=>$menu['module'],
                'type'=>'menu',
            ]);
        }
        $features = [

            // Dashboard
            ['name'=>'Lihat Dashboard','slug'=>'dashboard.view','module'=>'dashboard','parent'=>'dashboard'],
            // Kasir
            ['name'=>'Lihat Kasir','slug'=>'kasir.view','module'=>'kasir','parent'=>'kasir'],
            // Supplier
            ['name'=>'Lihat Supplier','slug'=>'supplier.view','module'=>'supplier','parent'=>'supplier'],
            ['name'=>'Tambah Supplier','slug'=>'supplier.create','module'=>'supplier','parent'=>'supplier'],
            ['name'=>'Edit Supplier','slug'=>'supplier.edit','module'=>'supplier','parent'=>'supplier'],
            ['name'=>'Hapus Supplier','slug'=>'supplier.delete','module'=>'supplier','parent'=>'supplier'],

            // Product
            ['name'=>'Lihat Produk','slug'=>'product.view','module'=>'product','parent'=>'product'],
            ['name'=>'Tambah Produk','slug'=>'product.create','module'=>'product','parent'=>'product'],
            ['name'=>'Edit Produk','slug'=>'product.edit','module'=>'product','parent'=>'product'],
            ['name'=>'Hapus Produk','slug'=>'product.delete','module'=>'product','parent'=>'product'],

            // Purchase
            ['name'=>'Lihat Pembelian','slug'=>'purchase.view','module'=>'purchase','parent'=>'purchase'],
            ['name'=>'Tambah Pembelian','slug'=>'purchase.create','module'=>'purchase','parent'=>'purchase'],
            ['name'=>'Edit Pembelian','slug'=>'purchase.edit','module'=>'purchase','parent'=>'purchase'],
            // Sale
            ['name'=>'Lihat Penjualan','slug'=>'sale.view','module'=>'sale','parent'=>'sale'],
            ['name'=>'Tambah Penjualan','slug'=>'sale.create','module'=>'sale','parent'=>'sale'],
            ['name'=>'Edit Penjualan','slug'=>'sale.edit','module'=>'sale','parent'=>'sale'],
            ['name'=>'Hapus Penjualan','slug'=>'sale.delete','module'=>'sale','parent'=>'sale'],

            // Order Jasa
            ['name'=>'Lihat Order Jasa','slug'=>'order-jasa.view','module'=>'order-jasa','parent'=>'order-jasa'],
            ['name'=>'Tambah Order Jasa','slug'=>'order-jasa.create','module'=>'order-jasa','parent'=>'order-jasa'],
            ['name'=>'Edit Order Jasa','slug'=>'order-jasa.edit','module'=>'order-jasa','parent'=>'order-jasa'],
            ['name'=>'Hapus Order Jasa','slug'=>'order-jasa.delete','module'=>'order-jasa','parent'=>'order-jasa'],

            // user admin
            ['name'=>'Lihat Admin','slug'=>'admin.view','module'=>'user','parent'=>'user-management'],
            ['name'=>'Tambah Admin','slug'=>'admin.create','module'=>'user','parent'=>'user-management'],
            ['name'=>'Edit Admin','slug'=>'admin.edit','module'=>'user','parent'=>'user-management'],
            ['name'=>'Hapus Admin','slug'=>'admin.delete','module'=>'user','parent'=>'user-management'],

            // user karyawan
            ['name'=>'Lihat Karyawan','slug'=>'karyawan.view','module'=>'user','parent'=>'user-management'],
            ['name'=>'Tambah Karyawan','slug'=>'karyawan.create','module'=>'user','parent'=>'user-management'],
            ['name'=>'Edit Karyawan','slug'=>'karyawan.edit','module'=>'user','parent'=>'user-management'],
            ['name'=>'Hapus Karyawan','slug'=>'karyawan.delete','module'=>'user','parent'=>'user-management'],

            // user customer
            ['name'=>'Lihat Customer','slug'=>'customer.view','module'=>'user','parent'=>'user-management'],
            ['name'=>'Tambah Customer','slug'=>'customer.create','module'=>'user','parent'=>'user-management'],
            ['name'=>'Edit Customer','slug'=>'customer.edit','module'=>'user','parent'=>'user-management'],
            ['name'=>'Hapus Customer','slug'=>'customer.delete','module'=>'user','parent'=>'user-management'],

            // category 
            ['name'=>'Lihat Category','slug'=>'category.view','module'=>'category','parent'=>'category'],
            ['name'=>'Tambah Category','slug'=>'category.create','module'=>'category','parent'=>'category'],
            ['name'=>'Edit Category','slug'=>'category.edit','module'=>'category','parent'=>'category'],
            ['name'=>'Hapus Category','slug'=>'category.delete','module'=>'category','parent'=>'category'],

            // subcategory
            ['name'=>'Lihat SubCategory','slug'=>'subcategory.view','module'=>'subcategory','parent'=>'subcategory'],
            ['name'=>'Tambah SubCategory','slug'=>'subcategory.create','module'=>'subcategory','parent'=>'subcategory'],
            ['name'=>'Edit SubCategory','slug'=>'subcategory.edit','module'=>'subcategory','parent'=>'subcategory'],
            ['name'=>'Hapus SubCategory','slug'=>'subcategory.delete','module'=>'subcategory','parent'=>'subcategory'],

                // unit
            ['name'=>'Lihat Unit','slug'=>'unit.view','module'=>'unit','parent'=>'unit'],
            ['name'=>'Tambah Unit','slug'=>'unit.create','module'=>'unit','parent'=>'unit'],
            ['name'=>'Edit Unit','slug'=>'unit.edit','module'=>'unit','parent'=>'unit'],
            ['name'=>'Hapus Unit','slug'=>'unit.delete','module'=>'unit','parent'=>'unit'],

            // Laporan
            ['name'=>'Laporan Penjualan Transaksi','slug'=>'laporan.transaksi','module'=>'laporan','parent'=>'laporan'],
            ['name'=>'Laporan Penjualan Item','slug'=>'laporan.per-item','module'=>'laporan','parent'=>'laporan'],
            ['name'=>'Laporan Stok','slug'=>'laporan.stok','module'=>'laporan','parent'=>'laporan'],

            // role & permission management
            ['name'=>'Kelola Role & Permission','slug'=>'admin.manage','module'=>'permission','parent'=>'permission'],

        ];


        foreach ($features as $feature) {

            $parent = Permission::where('slug',$feature['parent'])->first();

            Permission::create([
                'name' => $feature['name'],
                'slug' => $feature['slug'],
                'module' => $feature['module'],
                'type' => 'feature',
                'parent_id' => $parent->id ?? null,
                'order' => 0,
                'is_active' => true
            ]);

        }
        // ========================================
        // ASSIGN PERMISSIONS TO ROLES
        // ========================================
        
        // Super Admin - Akses Semua (tidak perlu assign, cek di model)
        
        // Admin - Akses hampir semua kecuali kelola hak akses
        $adminPermissions = Permission::whereNotIn('slug',[
            'admin.manage'
        ])->pluck('id');

        $admin->permissions()->attach($adminPermissions);

        
        

        // Customer - Tidak ada permission (handle manual di code)
    }
}