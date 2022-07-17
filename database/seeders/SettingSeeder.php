<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'قيمة الكورس',
            'key' => 'course_ly',
            'value' => '800',
        ]);

        Setting::create([
            'name' => 'قيمة الكورس',
            'key' => 'course_us',
            'value' => '143',
        ]);
    }
}
