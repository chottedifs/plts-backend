<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use App\Models\Admin;
use App\Models\Petugas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Lokasi::create([
            'nama_lokasi' => 'VIKTOR',
        ]);

        Admin::create([
            'nama_lengkap' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'lokasi_id' => 1,
            'nip' => '182011022201',
            'no_hp' => '0897129202100',
            'jenis_kelamin' => 'Laki-Laki',
            'status_admin' => true,
        ]);

        Petugas::create([
            'nama_lengkap' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('petugas123'),
            'lokasi_id' => 1,
            'nip' => '182011022201',
            'no_hp' => '0897129202100',
            'jenis_kelamin' => 'Laki-Laki',
            'status_petugas' => true,
        ]);
    }
}
