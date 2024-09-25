<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CmsSeeder extends Seeder
{

    protected $cms;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            $this->cms = DB::table('cms')->insertGetId([
                'status' => 'active',
                'image' => $i . '.jpg' // Include file extension in image name
            ]);

            DB::table('cms_translations')->insert([
                [
                    'cms_id' => $this->cms,
                    'locale' => 'ar',
                    'name' => 'المقاله رقم ' . $i,
                    'alt_image' => 'تعريف الصوره رقم ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'meta_title' => 'وصف صغير للمقاله رقم ' . $i,
                    'meta_des'=>'ميتا الوصف ',
                    'des' => ' يتم استخدام نص لوريم ipum الملء من قبل مصممي الجرافيك والمبرمجين والطابعات بهدف شغل مساحات موقع ويب أو منتج إعلاني أو إنتاج تحريري لم يكن نصه النهائي جاهزًا بعد.

                    تعمل هذه الوسيلة على تكوين فكرة عن المنتج النهائي الذي سيتم طباعته أو نشره قريبًا عبر القنوات الرقمية.
                    
                    من أجل الحصول على نتيجة أكثر انسجامًا مع النتيجة النهائية ، يقوم مصممو الرسوم أو المصممون أو المطبعون بالإبلاغ عن نص Lorem ipsum فيما يتعلق بجانبين أساسيين ، وهما قابلية القراءة ومتطلبات التحرير.
                    
                    إن اختيار الخط وحجم الخط الذي يتم من خلاله إعادة إنتاج Lorem ipsum يمثل إجابات لاحتياجات محددة تتجاوز مجرد ملء المساحات البسيطة والبسيطة المخصصة لقبول النصوص الحقيقية والسماح بالحصول على منتج إعلاني / نشر ، كل من الويب والورق ، طبقًا للواقع.
                    
                    يسمح هذا الهراء للعين بالتركيز فقط على التخطيط الرسومي لتقييم الخيارات الأسلوبية للمشروع بشكل موضوعي ، لذلك يتم تثبيته على العديد من البرامج الرسومية على العديد من منصات برامج النشر الشخصي ونظام إدارة المحتوى.' . $i,
                    'slug'=>'وصف تعريفي للمقاله رقم' . $i
                ],
            ]);

            DB::table('cms_translations')->insert([
                [
                    'cms_id' => $this->cms,
                    'locale' => 'en',
                    'name' => 'Slider Number ' . $i,
                    'alt_image' => 'alt_image Number ' . $i,
                    'title_image' => 'title_image Number ' . $i,
                    'meta_des' => ' meta descrition Number ' . $i,
                    'meta_title' => ' meta title Number ' . $i,
                    'des'  => 'Description Number This Is Descrption Number ' . $i,
                    'slug' =>'Slug Number One',
                ],
            ]);
        }
    }
}
