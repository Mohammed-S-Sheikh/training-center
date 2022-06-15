<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => 'نهى عمران سلطان',
            'phone' => '0926744543',
            'email' => '5875952@gmail.com',
            'password' => Hash::make('W92TKypp'),
            'is_admin' => 1,
            'city_id' => City::where('name', 'طرابلس')->value('id'),
        ]);
    }
}
