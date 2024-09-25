<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{

    protected $service;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) {
            $this->service = DB::table('services')->insertGetId([
                'price'       => '32' . $i,
                'category_id' => $i, // Include file extension in image name
                'star'        => null,
            ]);

            DB::table('service_translations')->insert([
                [
                    'service_id' => $this->service,
                    'slug'=>'الوصف التعريفي',
                    'locale' => 'ar',
                    'name' => 'الخدمه رقم ' . $i,
                    'meta_title'=> 'meta title' . $i,
                    'meta_des'=> 'meta des' . $i,
                    'des' => 'من أجل الحصول على نتيجة أكثر انسجامًا مع النتيجة النهائية ، يقوم مصممو الرسوم أو المصممون أو المطبعون بالإبلاغ عن نص Lorem ipsum فيما يتعلق بجانبين أساسيين ، وهما قابلية القراءة ومتطلبات التحرير.

                    إن اختيار الخط وحجم الخط الذي يتم من خلاله إعادة إنتاج Lorem ipsum يمثل إجابات لاحتياجات محددة تتجاوز مجرد ملء المساحات البسيطة والبسيطة المخصصة لقبول النصوص الحقيقية والسماح بالحصول على منتج إعلاني / نشر ، كل من الويب والورق ، طبقًا للواقع.
                    
                    يسمح هذا الهراء للعين بالتركيز فقط على التخطيط الرسومي لتقييم الخيارات الأسلوبية للمشروع بشكل موضوعي ، لذلك يتم تثبيته على العديد من البرامج الرسومية على العديد من منصات برامج النشر الشخصي ونظام إدارة المحتوى. ',
                ],
            ]);

            DB::table('service_translations')->insert([
                [
                    'service_id' => $this->service,
                    'locale' => 'en',
                    'name' => 'Service Number  ' . $i,
                    'meta_title'=> 'meta title' . $i,
                    'meta_des'=> 'meta des' . $i,
                    'des' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.',
                    'slug' => 'Slug Number 1'
                ],
            ]);


            for ($x = 1; $x <= 2; $x++) {
            DB::table('services_gallaries')->insert([
                [
                    'service_id' => $this->service,
                    'photo' => $x .'jpg',
                ],
            ]);
        }



        }
    }
}
