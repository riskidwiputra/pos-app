<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'level' => 0,
            'description' => 'Full access to all features',
            'is_active' => true,
        ]);

        $kasirRole = Role::create([
            'name' => 'Kasir',
            'slug' => 'kasir',
            'level' => 1,
            'description' => 'Access to cashier features',
            'is_active' => true,
        ]);

        $userRole = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'level' => 2,
            'description' => 'Limited access',
            'is_active' => true,
        ]);

        // Create Permissions - Menu Items
        $permissions = [
            // Dashboard
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'module' => 'Dashboard',
                'type' => 'menu',
                'icon' => 'fas fa-tachometer-alt',
                'url' => '/dashboard',
                'order' => 1,
                'description' => 'Access to dashboard',
                'roles' => ['admin', 'kasir', 'user'],
            ],

            // Product Management
            [
                'name' => 'Manajemen Produk',
                'slug' => 'product-management',
                'module' => 'Product',
                'type' => 'menu',
                'icon' => 'fas fa-box',
                'url' => null,
                'order' => 2,
                'description' => 'Product management module',
                'roles' => ['admin', 'kasir'],
                'children' => [
                    [
                        'name' => 'Daftar Produk',
                        'slug' => 'product.index',
                        'module' => 'Product',
                        'type' => 'menu',
                        'icon' => 'fas fa-list',
                        'url' => '/product',
                        'order' => 1,
                        'description' => 'View product list',
                        'roles' => ['admin', 'kasir'],
                    ],
                    [
                        'name' => 'Tambah Produk',
                        'slug' => 'product.create',
                        'module' => 'Product',
                        'type' => 'menu',
                        'icon' => 'fas fa-plus',
                        'url' => '/product/create',
                        'order' => 2,
                        'description' => 'Create new product',
                        'roles' => ['admin'],
                    ],
                    [
                        'name' => 'Kategori',
                        'slug' => 'category.index',
                        'module' => 'Product',
                        'type' => 'menu',
                        'icon' => 'fas fa-tags',
                        'url' => '/category',
                        'order' => 3,
                        'description' => 'Manage categories',
                        'roles' => ['admin'],
                    ],
                ],
            ],

            // User Management
            [
                'name' => 'Manajemen User',
                'slug' => 'user-management',
                'module' => 'User',
                'type' => 'menu',
                'icon' => 'fas fa-users',
                'url' => null,
                'order' => 3,
                'description' => 'User management module',
                'roles' => ['admin'],
                'children' => [
                    [
                        'name' => 'Daftar User',
                        'slug' => 'user.index',
                        'module' => 'User',
                        'type' => 'menu',
                        'icon' => 'fas fa-user-friends',
                        'url' => '/user',
                        'order' => 1,
                        'description' => 'View user list',
                        'roles' => ['admin'],
                    ],
                    [
                        'name' => 'Role',
                        'slug' => 'role.index',
                        'module' => 'User',
                        'type' => 'menu',
                        'icon' => 'fas fa-user-tag',
                        'url' => '/role',
                        'order' => 2,
                        'description' => 'Manage roles',
                        'roles' => ['admin'],
                    ],
                    [
                        'name' => 'Permission',
                        'slug' => 'permission.index',
                        'module' => 'User',
                        'type' => 'menu',
                        'icon' => 'fas fa-shield-alt',
                        'url' => '/permission',
                        'order' => 3,
                        'description' => 'Manage permissions',
                        'roles' => ['admin'],
                    ],
                ],
            ],

            // Settings
            [
                'name' => 'Pengaturan',
                'slug' => 'settings',
                'module' => 'Setting',
                'type' => 'menu',
                'icon' => 'fas fa-cog',
                'url' => null,
                'order' => 99,
                'description' => 'Application settings',
                'roles' => ['admin'],
                'children' => [
                    [
                        'name' => 'Menu Role',
                        'slug' => 'menu-role.index',
                        'module' => 'Setting',
                        'type' => 'menu',
                        'icon' => 'fas fa-list-ul',
                        'url' => '/menu-role',
                        'order' => 1,
                        'description' => 'Manage menu roles',
                        'roles' => ['admin'],
                    ],
                    [
                        'name' => 'Backup Database',
                        'slug' => 'backup.index',
                        'module' => 'Setting',
                        'type' => 'menu',
                        'icon' => 'fas fa-database',
                        'url' => '/backup',
                        'order' => 2,
                        'description' => 'Database backup',
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];

        // Create Permissions - Features
        $features = [
            // Product Features
            [
                'name' => 'Create Product',
                'slug' => 'product.create.action',
                'module' => 'Product',
                'type' => 'feature',
                'description' => 'Create new product',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Update Product',
                'slug' => 'product.update',
                'module' => 'Product',
                'type' => 'feature',
                'description' => 'Update existing product',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Delete Product',
                'slug' => 'product.delete',
                'module' => 'Product',
                'type' => 'feature',
                'description' => 'Delete product',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Read Product',
                'slug' => 'product.read',
                'module' => 'Product',
                'type' => 'feature',
                'description' => 'View product details',
                'roles' => ['admin', 'kasir'],
            ],

            // User Features
            [
                'name' => 'Create User',
                'slug' => 'user.create.action',
                'module' => 'User',
                'type' => 'feature',
                'description' => 'Create new user',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Update User',
                'slug' => 'user.update',
                'module' => 'User',
                'type' => 'feature',
                'description' => 'Update existing user',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Delete User',
                'slug' => 'user.delete',
                'module' => 'User',
                'type' => 'feature',
                'description' => 'Delete user',
                'roles' => ['admin'],
            ],

            // Role Features
            [
                'name' => 'Manage Roles',
                'slug' => 'role.manage',
                'module' => 'User',
                'type' => 'feature',
                'description' => 'Full role management',
                'roles' => ['admin'],
            ],

            // Permission Features
            [
                'name' => 'Manage Permissions',
                'slug' => 'permission.manage',
                'module' => 'User',
                'type' => 'feature',
                'description' => 'Full permission management',
                'roles' => ['admin'],
            ],
        ];

        // Helper function to create permissions recursively
        $createPermission = function($permData, $parentId = null) use (&$createPermission) {
            $roles = $permData['roles'] ?? [];
            $children = $permData['children'] ?? [];
            
            unset($permData['roles'], $permData['children']);
            
            $permission = Permission::create(array_merge($permData, [
                'parent_id' => $parentId,
            ]));

            // Attach roles
            $roleIds = Role::whereIn('slug', $roles)->pluck('id')->toArray();
            if (!empty($roleIds)) {
                $permission->roles()->attach($roleIds);
            }

            // Create children recursively
            foreach ($children as $child) {
                $createPermission($child, $permission->id);
            }

            return $permission;
        };

        // Create menu permissions
        foreach ($permissions as $permData) {
            $createPermission($permData);
        }
 
        // Create feature permissions
        foreach ($features as $featureData) {
            $roles = $featureData['roles'] ?? [];
            unset($featureData['roles']);
            
            $feature = Permission::create($featureData);
            
            $roleIds = Role::whereIn('slug', $roles)->pluck('id')->toArray();
            if (!empty($roleIds)) {
                $feature->roles()->attach($roleIds);
            }
        }

        // Create default admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        // Create kasir user
        User::create([
            'name' => 'Kasir User',
            'email' => 'kasir@example.com',
            'password' => bcrypt('password'),
            'role_id' => $kasirRole->id,
            'is_active' => true,
        ]);

        $this->command->info('Roles, Permissions, and Users seeded successfully!');
    }
}
