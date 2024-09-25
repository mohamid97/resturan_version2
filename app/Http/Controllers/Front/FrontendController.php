<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\StoreMessage;
use App\Models\Admin\About;
use App\Models\Admin\Category;
use App\Models\Admin\Cms;
use App\Models\Admin\Contactus;
use App\Models\Admin\File;
use App\Models\Admin\Message;
use App\Models\Admin\Meta;
use App\Models\Admin\MetaBlogs;
use App\Models\Admin\MetaProjects;
use App\Models\Admin\MetaServices;
use App\Models\Admin\Ourwork;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FrontendController extends Controller
{
    private $seo = [];
    //
    public function about() {

        $about = About::first();
        $this->seo['meta_title'] = $about->translate(app()->getLocale())->meta_title;
        $this->seo['meta_des']   = $about->translate(app()->getLocale())->meta_des;
        $this->seo['title']      = $about->translate(app()->getLocale())->meta_title;
        return view('front.about' , ['about'=>$about , 'seo' => $this->seo]);
        
    }
    public function contact() {
        $contact = Contactus::first();
        $this->seo['meta_title'] = $contact->translate(app()->getLocale())->meta_title;
        $this->seo['meta_des']   = $contact->translate(app()->getLocale())->meta_des;
        $this->seo['title']      = $contact->translate(app()->getLocale())->meta_title;
        return view('front.contact');
    }

    public function message(StoreMessage $request) {

        try{
            DB::beginTransaction();
            Message::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'subject'=>$request->subject,
                'message'=>$request->message,
                'email'=>$request->email
            ]);
            
            DB::commit();
            Alert::success('تهانينا', 'تم ارسال رسالتك');
            return redirect()->back();

        }catch(\Exception $e){
            dd($e->getMessage() , $e->getLine());
            DB::rollBack();
            return redirect()->back();
        }
        
    }

    public function services(){

        $category = Category::with('services')->get();
        $meta = MetaServices::first();
        if(isset($meta)){
            $this->seo['meta_title'] =  $meta->translate(app()->getLocale())->meta_title;
            $this->seo['meta_des']   =  $meta->translate(app()->getLocale())->meta_des;
            $this->seo['title']      =  $meta->translate(app()->getLocale())->meta_title;
            return view('front.services' , ['category' => $category , 'seo' => $this->seo ]);
        }
        return view('front.services' , ['category' => $category ]);

        
    }

    public function service_details($slug){
        $service = Service::with('gallery')->whereTranslation('slug' , $slug)->first();
        $this->seo['meta_title'] = $service->translate(app()->getLocale())->meta_title;
        $this->seo['meta_des'] = $service->translate(app()->getLocale())->meta_des; 
        $this->seo['title']    = $service->translate(app()->getLocale())->meta_title;
        return view('front.service_details' , ['service'=>$service , 'seo' => $this->seo]);
    }

    public function projects(){
        $projects = Ourwork::all();
        $meta = MetaProjects::first();
        if(isset($meta)){
            $this->seo['meta_title'] =  $meta->translate(app()->getLocale())->meta_title;
            $this->seo['meta_des']   =  $meta->translate(app()->getLocale())->meta_des;
            $this->seo['title']      =  $meta->translate(app()->getLocale())->meta_title;
            

        }

        return view('front.projcets' , ['projects' => $projects]);

    }

    public function blog(){
        $blogs = Cms::all();
        $meta = MetaBlogs::first();

        if($meta){
            $this->seo['meta_title'] =  $meta->translate(app()->getLocale())->meta_title;
            $this->seo['meta_des']   =  $meta->translate(app()->getLocale())->meta_des;
            $this->seo['title']      =  $meta->translate(app()->getLocale())->meta_title;
            return view('front.blog' , [ 'blogs'=>$blogs  , 'seo' =>$this->seo]);
        }
        return view('front.blog' , [ 'blogs'=>$blogs]);



    }

    public function blog_details($slug){
        $blog = Cms::whereTranslation('slug' , $slug)->first();
        $this->seo['meta_title'] = $blog->translate(app()->getLocale())->meta_title;
        $this->seo['meta_des']   = $blog->translate(app()->getLocale())->meta_des; 
        $this->seo['title']      = $blog->translate(app()->getLocale())->meta_title;
        $files = File::all();
 
        return view('front.blog_details' , ['blog'=>$blog , 'files'=>$files , 'seo'=>$this->seo]);
    }

    public function latest_blog(){
        $this->seo['meta_title'] = 'أخر المقالات في موقع الماسه';
        $this->seo['meta_des']   = ' أخر مقالات تم نشرها في موقع الماسه'; 
        $this->seo['title']      = 'احدث المقالات';
        $blogs = Cms::latest()->take(5)->get();
        return view('front.latest_blog' , ['blogs' => $blogs , 'seo'=>$this->seo]);
    }

    public function get_service_category(Request $request){

        $categoryId = $request->query('category');

        // Fetch services based on the category ID
        $services = Service::where('category_id', $categoryId)->get();
        return response()->json($services);
        
    }






}
