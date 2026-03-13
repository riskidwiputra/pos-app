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

            ['name'=>'Dashboard', 'module'=>'dashboard', 'slug'=>'dashboard','url'=>'/dashboard','icon'=>'dashboard'],

            ['name'=>'Kasir','module'=>'kasir', 'slug'=>'kasir','url'=>'/cashier','icon'=>'cashier'],

            ['name'=>'Supplier','module'=>'supplier', 'slug'=>'supplier','url'=>'/supplier','icon'=>'supplier'],

            ['name'=>'Produk','module'=>'product', 'slug'=>'product','url'=>'/product','icon'=>'product'],

            ['name'=>'Pembelian','module'=>'purchase', 'slug'=>'purchase','url'=>'/purchase','icon'=>'purchase'],

            ['name'=>'Penjualan','module'=>'sale', 'slug'=>'sale','url'=>'/sale','icon'=>'sale'],

            ['name'=>'Permission','module'=>'permission', 'slug'=>'permission','url'=>'/roles/manage-permissions','icon'=>'permission'],

            ['name'=>'Order Jasa','module'=>'order-jasa', 'slug'=>'order-jasa','url'=>'/order-jasa','icon'=>'order-jasa'],

            ['name'=>'Data User','module'=>'user', 'slug'=>'user-management','url'=>'#','icon'=>'user'],

            ['name'=>'Master Data','module'=>'master-data', 'slug'=>'master-data','url'=>'#','icon'=>'database'],

            ['name'=>'Laporan','module'=>'laporan', 'slug'=>'laporan','url'=>'#','icon'=>'report']

        ];

        foreach ($menus as $menu) {

            Permission::create([
                'name'=>$menu['name'],
                'slug'=>$menu['slug'],
                'module'=>$menu['module'],
                'type'=>'menu',
                'url'=>$menu['url'],
                'icon'=>$menu['icon']
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

            // User
            ['name'=>'Kelola Admin','slug'=>'admin.manage','module'=>'user','parent'=>'user-management'],
            ['name'=>'Kelola Karyawan','slug'=>'karyawan.manage','module'=>'user','parent'=>'user-management'],
            ['name'=>'Kelola Customer','slug'=>'customer.manage','module'=>'user','parent'=>'user-management'],

            // Master Data
            ['name'=>'Kelola Category','slug'=>'category.manage','module'=>'master-data','parent'=>'master-data'],
            ['name'=>'Kelola SubCategory','slug'=>'subcategory.manage','module'=>'master-data','parent'=>'master-data'],
            ['name'=>'Kelola Unit','slug'=>'unit.manage','module'=>'master-data','parent'=>'master-data'],

            // Laporan
            ['name'=>'Laporan Penjualan Transaksi','slug'=>'laporan.transaksi','module'=>'laporan','parent'=>'laporan'],
            ['name'=>'Laporan Penjualan Item','slug'=>'laporan.per-item','module'=>'laporan','parent'=>'laporan'],
            ['name'=>'Laporan Stok','slug'=>'laporan.stok','module'=>'laporan','parent'=>'laporan'],

        ];


        foreach ($features as $feature) {

            $parent = Permission::where('slug',$feature['parent'])->first();

            Permission::create([
                'name' => $feature['name'],
                'slug' => $feature['slug'],
                'module' => $feature['module'],
                'type' => 'feature',
                'parent_id' => $parent->id ?? null,
                'icon' => null,
                'url' => null,
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