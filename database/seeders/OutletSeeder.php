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
            'name_outlet' => 'Toko 1',
            'id_user' => 1,
            'id_rate' => 1
        ]);

        Outlet::create([
            'name_outlet' => 'Toko 2',
            'id_user' => 2,
            'id_rate' => 2
        ]);
    }
}
