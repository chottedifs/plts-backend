<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id_outlet' => 1,
            'id_tagihan' => 2,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => \bcrypt('admin123'),
            'phone_number' => '085111231145',
            'roles' => 'admin',
            'is_active' => true
        ]);

        User::create([
            'id_outlet' => 2,
            'id_tagihan' => 1,
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'password' => \bcrypt('admin123'),
            'phone_number' => '085111231165',
            'roles' => 'admin',
            'is_active' => true
        ]);
    }
}
