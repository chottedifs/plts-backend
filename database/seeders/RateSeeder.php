<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rate::create([
            "type" => "Premium",
            "price" => 600000
        ]);

        Rate::create([
            "type" => "Gold",
            "price" => 500000
        ]);

        Rate::create([
            "type" => "Silver",
            "price" => 400000
        ]);
    }
}
