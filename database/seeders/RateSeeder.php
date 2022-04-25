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
            "type" => "contoh 1",
            "price" => 500000
        ]);

        Rate::create([
            "type" => "contoh 2",
            "price" => 600000
        ]);
    }
}
