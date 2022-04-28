<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outlet::create([
            // 'id_user' => 1,
            'id_rate' => 1,
            'name_kios' => 'KIOS 001',
            'luas_kios' => '3 x 4',
            'status_kios' => true
        ]);

        Outlet::create([
            // 'id_user' => 2,
            'id_rate' => 2,
            'name_kios' => 'KIOS 002',
            'luas_kios' => '4 x 4',
            'status_kios' => true
        ]);

        Outlet::create([
            // 'id_user' => 2,
            'id_rate' => 3,
            'name_kios' => 'KIOS 003',
            'luas_kios' => '4 x 5',
        ]);

        Outlet::create([
            // 'id_user' => 2,
            'id_rate' => 2,
            'name_kios' => 'KIOS 004',
            'luas_kios' => '5 x 5',
        ]);

    }
}
