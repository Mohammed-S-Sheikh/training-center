<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\Country;
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
            'role' => 'admin',
            'city_id' => City::where('name', 'طرابلس')->value('id'),
            'country_id' => Country::where('name', 'ليبيا')->value('id'),
        ]);
    }
}
