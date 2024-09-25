<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $governorates = [
            ['code' => '001', 'name_ar' => 'القاهرة', 'name_en' => 'Cairo'],
            ['code' => '002', 'name_ar' => 'الجيزة', 'name_en' => 'Giza'],
            ['code' => '003', 'name_ar' => 'الأسكندرية', 'name_en' => 'Alexandria'],
            ['code' => '004', 'name_ar' => 'الدقهلية', 'name_en' => 'Dakahlia'],
            ['code' => '005', 'name_ar' => 'البحر الأحمر', 'name_en' => 'Red Sea'],
            ['code' => '006', 'name_ar' => 'البحيرة', 'name_en' => 'Beheira'],
            ['code' => '007', 'name_ar' => 'الفيوم', 'name_en' => 'Fayoum'],
            ['code' => '008', 'name_ar' => 'الغربية', 'name_en' => 'Gharbiya'],
            ['code' => '009', 'name_ar' => 'الإسماعلية', 'name_en' => 'Ismailia'],
            ['code' => '010', 'name_ar' => 'المنوفية', 'name_en' => 'Menofia'],
            ['code' => '011', 'name_ar' => 'المنيا', 'name_en' => 'Minya'],
            ['code' => '012', 'name_ar' => 'القليوبية', 'name_en' => 'Qaliubiya'],
            ['code' => '013', 'name_ar' => 'الوادي الجديد', 'name_en' => 'New Valley'],
            ['code' => '014', 'name_ar' => 'السويس', 'name_en' => 'Suez'],
            ['code' => '015', 'name_ar' => 'اسوان', 'name_en' => 'Aswan'],
            ['code' => '016', 'name_ar' => 'اسيوط', 'name_en' => 'Assiut'],
            ['code' => '017', 'name_ar' => 'بني سويف', 'name_en' => 'Beni Suef'],
            ['code' => '018', 'name_ar' => 'بورسعيد', 'name_en' => 'Port Said'],
            ['code' => '019', 'name_ar' => 'دمياط', 'name_en' => 'Damietta'],
            ['code' => '020', 'name_ar' => 'الشرقية', 'name_en' => 'Sharkia'],
            ['code' => '021', 'name_ar' => 'جنوب سيناء', 'name_en' => 'South Sinai'],
            ['code' => '022', 'name_ar' => 'كفر الشيخ', 'name_en' => 'Kafr Al sheikh'],
            ['code' => '023', 'name_ar' => 'مطروح', 'name_en' => 'Matrouh'],
            ['code' => '024', 'name_ar' => 'الأقصر', 'name_en' => 'Luxor'],
            ['code' => '025', 'name_ar' => 'قنا', 'name_en' => 'Qena'],
            ['code' => '026', 'name_ar' => 'شمال سيناء', 'name_en' => 'North Sinai'],
            ['code' => '027', 'name_ar' => 'سوهاج', 'name_en' => 'Sohag'],
        ];

        foreach ($governorates as $governorate) {
            $governorateId = DB::table('governorates')->insertGetId([
                'code' => $governorate['code'],
            ]);

            DB::table('governorate_translations')->insert([
                [
                    'small_des' => null,
                    'des' => null,
                    'name' => $governorate['name_ar'],
                    'governorate_id' => $governorateId,
                    'locale' => 'ar'
                ],
                [
                    'small_des' => null,
                    'des' => null,
                    'name' => $governorate['name_en'],
                    'governorate_id' => $governorateId,
                    'locale' => 'en'
                ]
            ]);
        }



    }
}
