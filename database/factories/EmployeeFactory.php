<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $jenis_kelamin = $this->faker->randomElement(['Laki-laki', 'Perempuan']);
        $posisiList = [
            'Kasir', 'Desainer Grafis', 'Teknisi Mesin Cetak', 'Admin',
            'Manajer Toko', 'Staff Produksi', 'Customer Service', 'Marketing',
            'Driver', 'Supervisor'
        ];

        return [
            'nama_lengkap' => $this->faker->name($jenis_kelamin === 'Laki-laki' ? 'male' : 'female'),
            'no_telepon' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '2002-01-01'),
            'jenis_kelamin' => $jenis_kelamin,
            'posisi' => $this->faker->randomElement($posisiList),
            'tanggal_masuk' => $this->faker->date('Y-m-d', '2023-12-31'),
            'gaji' => $this->faker->numberBetween(3000000, 8000000),
            'status_pekerjaan' => $this->faker->randomElement(['Aktif', 'Tidak Aktif', 'Cuti']),
        ];
    }
}
