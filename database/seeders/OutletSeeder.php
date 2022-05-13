<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Outlet;
use App\Models\TypeRates;

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
            'user_id' => 1,
            'type_rate_id' => 1,
            'name_kios' => 'KIOS 001',
            'luas_kios' => '3 x 4',
            'status_kios' => true
        ]);

        Outlet::create([
            'user_id' => 2,
            'type_rate_id' => 2,
            'name_kios' => 'KIOS 002',
            'luas_kios' => '4 x 4',
            'status_kios' => true
        ]);

    }
}
