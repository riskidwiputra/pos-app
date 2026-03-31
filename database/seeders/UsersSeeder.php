<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
            'username' => 'superadmin',
            'role_id' => 1,
        ]);

            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'username' => 'admin',
                'role_id' => 2,
            ]);

            $pelanggan = User::create([
                'name' => 'Pelanggan',
                'email' => 'pelanggan@example.com',
                'password' => bcrypt('password'),
                'username' => 'pelanggan',
                'role_id' => 3,
            ]);
    }
}
