<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SescriptionSeeder extends Seeder
{
    protected $des;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            $this->des = DB::table('des')->insertGetId([
                'type' => 'blog',
            ]);

            DB::table('des_translations')->insert([
                [
                    'des_id' => $this->des,
                    'locale' => 'ar',
                    'name' => 'الوصف رقم ' . $i,
                    'des' => 'إنه بالتأكيد أشهر نص نائب حتى إذا كانت هناك إصدارات مختلفة يمكن تمييزها عن ترتيب تكرار الكلمات اللاتينية.

                    يحتوي Lorem ipsum على المحارف الأكثر استخدامًا ، وهو جانب يتيح لك الحصول على نظرة عامة على عرض النص من حيث اختيار الخط و حجم الخط .
                    
                    عند الإشارة إلى Lorem ipsum ، يتم استخدام تعبيرات مختلفة ، وبالتحديد ملء النص أو نص وهمي أو نص مخفي أو < قوي> نص عنصر نائب : باختصار ، يمكن أن يكون معناه أيضًا صفريًا ، ولكن فائدته واضحة جدًا بحيث تستمر عبر القرون وتقاوم الإصدارات السخرية والحديثة التي جاءت مع وصول الويب.'
                ],
            ]);

            DB::table('des_translations')->insert([
                [
                    'des_id' => $this->des,
                    'locale' => 'en',
                    'name' => 'des Number ' . $i,
                    'des' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.',
                ],
            ]);
        }
    }
}
