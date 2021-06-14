<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'email' => '123qwe@gmail.com',
            'password' => Hash::make('123qwe'),
            'refresh_token' => 'rqqD9RoMxdIy8E1nBkDnv2Zw8wqiGEvu',
            'is_admin' => true,
        ]);
    }
}
