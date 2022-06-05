<?php

namespace Database\Seeders;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            ['name' => 'طرابلس'],
            ['name' => 'بنغازي'],
            ['name' => 'مصراتة'],
            ['name' => 'الزاوية'],
            ['name' => 'زليتن'],
            ['name' => 'البيضاء'],
            ['name' => 'اجدابيا'],
            ['name' => 'غريان'],
            ['name' => 'طبرق'],
            ['name' => 'صبراتة'],
            ['name' => 'سبها'],
            ['name' => 'الخمس'],
            ['name' => 'درنة'],
            ['name' => 'سرت'],
            ['name' => 'الجميل'],
            ['name' => 'الكفرة'],
            ['name' => 'المرج'],
            ['name' => 'يفرن'],
            ['name' => 'ترهونة'],
            ['name' => 'مسلاتة'],
            ['name' => 'بني وليد'],
            ['name' => 'صرمان'],
            ['name' => 'رقدالين'],
            ['name' => 'الزنتان'],
            ['name' => 'زوارة'],
            ['name' => 'شحات'],
            ['name' => 'أوباري'],
            ['name' => 'الأبيار'],
            ['name' => 'زلطن'],
            ['name' => 'القبة'],
            ['name' => 'تاورغاء'],
            ['name' => 'الماية'],
            ['name' => 'مرزق'],
            ['name' => 'البريقة'],
            ['name' => 'هون'],
            ['name' => 'جالو'],
            ['name' => 'نالوت'],
            ['name' => 'سلوق'],
            ['name' => 'مزدة'],
            ['name' => 'راس لانوف'],
            ['name' => 'العربان'],
            ['name' => 'ودان'],
            ['name' => 'العجيلات'],
            ['name' => 'توكرة'],
            ['name' => 'براك'],
            ['name' => 'غدامس'],
            ['name' => 'غات'],
            ['name' => 'أوجلة'],
            ['name' => 'سوسة'],
            ['name' => 'ربيانة'],
        ]);
    }
}
