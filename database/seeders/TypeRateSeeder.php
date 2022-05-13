<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeRate;

class TypeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeRate::create([
            "type" => "Premium",
            "price" => 600000
        ]);

        TypeRate::create([
            "type" => "Gold",
            "price" => 500000
        ]);

        TypeRate::create([
            "type" => "Silver",
            "price" => 400000
        ]);
    }
}
