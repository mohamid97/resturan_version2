<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\OurClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OurworkController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MetaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\DesController;
use App\Http\Controllers\Admin\AchievementConroller;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CartsController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Admin\FeaturedController;
use App\Http\Controllers\Admin\FeedBackController;
use App\Http\Controllers\Admin\FqaController;
use App\Http\Controllers\Admin\Government;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\MissionVission;
use App\Http\Controllers\Admin\MediaGroupcontroller;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PointsController;
use App\Http\Controllers\Admin\SocialAuthController;
use App\Http\Controllers\Admin\TypesController;
use App\Models\Admin\Payment;
use Faker\Guesser\Name;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;




Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);





Route::get('/mig' , function (){
    Artisan::call('migrate:fresh --seed');
});

Route::get('/login', [AuthController::class , 'show_login'])->name('showLogin');
Route::post('/login', [AuthController::class,'login'])->name('login');



    // change language 
Route::get('chang_lang/{lang}' , function($lang){

    App::setLocale($lang);
    Session::put('locale', $lang);
    return redirect()->back();
})->name('change_direction');

Route::middleware(['checkIfAdmin' , 'checkLocale'])->prefix('admin')->group(function (){
    Route::get('/' , [HomeController::class , 'index'])->name('admin.index');




    // start create types 
    Route::prefix('types')->group(function(){
        Route::get('get_type' , [TypesController::class , 'get_type'])->name('admin.types.index');
        Route::get('create_type' , [TypesController::class , 'create_type'])->name('admin.types.create');
        Route::post('store_type' , [TypesController::class , 'store_type'])->name('admin.types.store');
        Route::get('/edit_type/{id}' , [TypesController::class , 'edit_type'])->name('admin.types.edit');
        Route::post('/update_type/{id}' , [TypesController::class , 'update_type'])->name('admin.types.update');
        Route::get('/delete_type/{id}' , [TypesController::class , 'delete_type'])->name('admin.types.delete');
        Route::get('/show_options/{id}' , [TypesController::class , 'show_options'])->name('admin.types.show_options');

        Route::prefix('type_options')->group(function(){
            Route::get('create_option' , [TypesController::class , 'create_option'])->name('admin.types.type_option.create');
            Route::post('store_option' , [TypesController::class , 'store_option'])->name('admin.types.type_options.store');
            Route::get('/delete_option/{id}' , [TypesController::class , 'delete_option'])->name('admin.types.type_options.delete');
        });



    });

    Route::prefix('extra')->group(function(){
        Route::get('get' , [ExtraController::class , 'get'])->name('admin.extra.index');
        Route::get('edit/{id}' , [ExtraController::class , 'edit'])->name('admin.extra.edit');
        Route::get('create' , [ExtraController::class , 'create'])->name('admin.extra.create');
        Route::get('delete/{id}' , [ExtraController::class , 'delete'])->name('admin.extra.delete');
        Route::post('store' , [ExtraController::class , 'store'])->name('admin.extra.store');
        Route::post('update/{id}' , [ExtraController::class , 'update'])->name('admin.extra.update');


    });


    // start combo 
    Route::prefix('combo')->group(function(){

        Route::get('get' , [ComboController::class , 'get'])->name('admin.combo.index');
        Route::get('edit/{id}' , [ComboController::class , 'edit'])->name('admin.combo.edit');
        Route::get('create' , [ComboController::class , 'create'])->name('admin.combo.create');
        Route::get('delete/{id}' , [ComboController::class , 'delete'])->name('admin.combo.delete');
        Route::post('store' , [ComboController::class , 'store'])->name('admin.combo.store');
        Route::post('update/{id}' , [ComboController::class , 'update'])->name('admin.combo.update');


    });

    //start featured products
    Route::prefix('featured')->group(function(){
        Route::get('/get' , [FeaturedController::class ,'index'])->name('admin.featured.index');
        Route::get('/delete/{id}' , [FeaturedController::class , 'delete'])->name('admin.featured.delete');
        Route::post('store' , [ FeaturedController::class, 'store'])->name('admin.featured.store');
    });




    // login and regsiter

    Route::prefix('auth')->group(function () {
        Route::get('/update', [AuthController::class , 'show_update'])->name('admin.auth.showUpdate');
        Route::get('/logout', [AuthController::class , 'logout'])->name('admin.auth.logout');
        Route::post('/update', [AuthController::class,'update'])->name('admin.auth.update');
        
    });

    // start coupons
    Route::prefix('coupons')->group(function(){
        Route::get('/get' , [CouponController::class , 'index'])->name('admin.coupons.index');
        Route::get('/add', [CouponController::class , 'add'])->name('admin.coupons.add');
        Route::post('/store', [CouponController::class , 'store'])->name('admin.coupons.store');
        Route::get('/edit/{id}',[CouponController::class , 'edit'])->name('admin.coupons.edit');
        Route::post('/update/{id}' ,[CouponController::class , 'update'])->name('admin.coupons.update');
        Route::get('/destroy/{id}' , [CouponController::class , 'destroy'])->name('admin.coupons.destroy');
        Route::get('/soft_delete/{id}' , [CouponController::class , 'soft_delete'])->name('admin.coupons.soft_delete');
        Route::get('/restore/{id}' , [CouponController::class , 'restore'])->name('admin.coupons.restore');
    });

    // start points 
    Route::prefix('points')->group(function(){
       Route::get('index' , [PointsController::class , 'get'])->name('admin.points.index');
       Route::post('/update/points_price' ,[PointsController::class , 'update_price'])->name('admin.points_pirce.update');
    });
    // start slider
    Route::prefix('slider')->group(function (){
        Route::get('/' , [SlidersController::class , 'index'])->name('admin.sliders.index');
        Route::get('/add' , [SlidersController::class , 'create'])->name('admin.sliders.add');
        Route::post('/store' , [SlidersController::class , 'store'])->name('admin.sliders.store');
        Route::get('/edit/{id}' , [SlidersController::class , 'edit'])->name('admin.sliders.edit');
        Route::post('/update/{id}' , [SlidersController::class , 'update'])->name('admin.sliders.update');
        Route::get('/destroy/{id}' , [SlidersController::class , 'destroy'])->name('admin.sliders.destroy');
        Route::get('/soft_delete/{id}' , [SlidersController::class , 'soft_delete'])->name('admin.sliders.soft_delete');
        Route::get('/restore/{id}' , [SlidersController::class , 'restore'])->name('admin.sliders.restore');
        Route::get('/slider/setting' , [SlidersController::class , 'setting'])->name('admin.sliders.setting');
        Route::post('/slider/setting/update' , [SlidersController::class , 'update_setting'])->name('admin.sliders.setting_update');

    }); // end slider


    // start feedback 

    Route::prefix('feedbacks')->group(function(){
        Route::get('/' , [FeedBackController::class , 'index'])->name('admin.feedback.index');
        Route::get('/add' , [FeedBackController::class , 'create'])->name('admin.feedback.add');
        Route::post('/store' , [FeedBackController::class , 'store'])->name('admin.feedback.store');
        Route::get('/edit/{id}' , [FeedBackController::class , 'edit'])->name('admin.feedback.edit');
        Route::post('/update/{id}' , [FeedBackController::class , 'update'])->name('admin.feedback.update');
        Route::get('/destroy/{id}' , [FeedBackController::class , 'destroy'])->name('admin.feedback.destroy');
        Route::get('/soft_delete/{id}' , [FeedBackController::class , 'soft_delete'])->name('admin.feedback.soft_delete');
        Route::get('/restore/{id}' , [FeedBackController::class , 'restore'])->name('admin.feedback.restore');
    });


    // offers 
    Route::prefix('offers')->group(function(){
        Route::get('/' , [OffersController::class , 'index'])->name('admin.offers.index');
        Route::get('add' , [OffersController::class , 'add'])->name('admin.offers.add');
        Route::post('/store' , [OffersController::class , 'store'])->name('admin.offers.store');
        Route::get('/edit/{id}' , [OffersController::class , 'edit'])->name('admin.offers.edit');
        Route::post('/update/{id}' , [OffersController::class , 'update'])->name('admin.offers.update');
        Route::get('/show_products/{id}' , [OffersController::class , 'show_products'])->name('admin.offers.show_product');
        Route::post('/add_product/offer/{id}' , [OffersController::class , 'add_product_offer'])->name('admin.offers.add_product');
        Route::get('/offer/{offer_id}/product/{product_id}/delete' , [OffersController::class , 'delete_product_offer'])->name('admin.offers.delete_product');

        Route::get('/destroy/{id}' , [OffersController::class , 'destroy'])->name('admin.offers.destroy');
        Route::get('/soft_delete/{id}' , [OffersController::class , 'soft_delete'])->name('admin.offers.soft_delete');
        Route::get('/restore/{id}' , [OffersController::class , 'restore'])->name('admin.offers.restore');
    });


    // start carts for admin
    Route::prefix('carts')->group(function(){
        Route::get('/get' , [CartsController::class , 'get'])->name('admin.cards.index');
        Route::get('cart/delete/{id}', [CartsController::class , 'delete'])->name('admin.carts.delete');
        Route::get('cart/show/{id}' , [CartsController::class , 'show_details'])->name('admin.carts.show_details');
    });

    // orders
    Route::prefix('orders')->group(function(){

        Route::get('get' , [OrderController::class , 'get'])->name('admin.orders.index');
        Route::get('delete/{id}' , [OrderController::class , 'delete'])->name('admin.orders.delete');
        Route::get('show/{id}' , [OrderController::class , 'show_details'])->name('admin.orders.show_details');
        Route::get('edit/status/{id}' , [OrderController::class , 'edit_status'])->name('admin.orders.edit_status');
        Route::post('update/status/{id}', [OrderController::class , 'update_status'])->name('admin.order.update_status');

        // hire delivery 
        Route::get('/{id}/hire_delivery' , [OrderController::class , 'hire_delivery'])->name('admin.orders.hire_delivery');
        Route::post('/{id}/hire' , [OrderController::class , 'hire_delivery_store'])->name('admin.orders.hire_order_submit');
    });


    // start City Price
    Route::prefix('city_price')->group(function(){
        Route::get('get' , [Government::class , 'get'])->name('admin.city_price.index');
        Route::get('/edit_price/{id}' , [Government::class , 'edit_price'])->name('admin.city.edit');
        Route::post('/update_price/{id}' , [Government::class , 'update_price'])->name('admin.city.update_price');

        // start check gov and city
        Route::get('/chcek_gov' , [Government::class , 'check_gov'])->name('admin.city_price.check_gov');
        Route::post('/update_govs' , [Government::class , 'update_govs'] )->name('admin.city_price_update-govs');
        Route::get('chcek_city' , [Government::class , 'check_city'])->name('admin.city_price.check_city');
        Route::post('/update_city' , [Government::class , 'update_city'] )->name('admin.city_price_update_city');

   
    });



    Route::get('/mission_visison', [MissionVission::class , 'mision_vission'])->name('admin.mission_vission.index');
    Route::post('/mission_visison/store', [MissionVission::class , 'mision_vission_store'])->name('admin.mission_vission.store');



    // start messages

    Route::prefix('messages')->group(function (){
        Route::get('/' , [MessageController::class , 'index'])->name('admin.messages.index');
        Route::get('/show/{id}' , [MessageController::class , 'show'])->name('admin.messages.show');
        Route::get('/destroy/{id}' , [MessageController::class , 'destroy'])->name('admin.messages.destroy');
    });

    // start about us
    Route::prefix('about')->group(function (){
       Route::get('/' , [AboutController::class , 'index'])->name('admin.about.index');
       Route::post('/update/{id}' , [AboutController::class , 'update'])->name('admin.about.update');
    });


    // start  contact us
    Route::prefix('contact-us')->group(function (){
        Route::get('/' , [ContactUsController::class , 'index'])->name('admin.contact.index');
        Route::post('/update/{id}' , [ContactUsController::class , 'update'])->name('admin.contact.update');
    });


    // start social media
    Route::prefix('social-media')->group(function (){
        Route::get('/' , [SocialMediaController::class , 'index'])->name('admin.social_media.index');
        Route::post('/update/{id}' , [SocialMediaController::class , 'update'])->name('admin.social_media.update');
    });


    // start our clients
    Route::prefix('our_clients')->group(function (){
       Route::get('/' , [OurClientController::class , 'index'])->name('admin.our_clients.index');
       Route::get('/create' , [OurClientController::class , 'create'])->name('admin.our_clients.add');
       Route::post('/store' , [OurClientController::class , 'store'])->name('admin.our_clients.store');
       Route::get('/edit/{id}' , [OurClientController::class , 'edit'])->name('admin.our_clients.edit');
       Route::get('/soft_delete/{id}' , [OurClientController::class , 'soft_delete'])->name('admin.our_clients.soft_delete');
       Route::get('/restore/{id}' , [OurClientController::class , 'restore'])->name('admin.our_clients.restore');
       Route::get('/destroy/{id}' , [OurClientController::class , 'destroy'])->name('admin.our_clients.destroy');
       Route::post('/update/{id}' , [OurClientController::class , 'update'])->name('admin.our_clients.update');
    });


    // start payment integeration 

    Route::prefix('payments')->group(function(){
        Route::get('get' , [PaymentController::class , 'get'])->name('admin.payments.index');
        Route::post('settings' , [PaymentController::class , 'settings'])->name('admin.payments.settings');
        Route::get('status' , [PaymentController::class , 'get_status'])->name('admin.payments.status');
        Route::post('/edit/status' , [PaymentController::class, 'edit_status'])->name('admin.payments.edit_status');


    });



    // start faq 
    Route::prefix('faqs')->group(function(){

        Route::get('main_faq/get' , [FqaController::class , 'get_main_faq'])->name('admin.main_faq.index');
        Route::post('/main_faq/update' ,[FqaController::class , 'update_main_faq'])->name('admin.main_faq.update');
        Route::get('get' , [FqaController::class , 'get'])->name('admin.faq.index');
        Route::get('/create' , [FqaController::class , 'create'])->name('admin.faq.add');
        Route::post('/store' , [FqaController::class , 'store'])->name('admin.faq.store');
        Route::get('/edit/{id}' , [FqaController::class , 'edit'])->name('admin.faq.edit');
        Route::post('/update/{id}' , [FqaController::class , 'update'])->name('admin.faq.update');
        Route::get('/soft_delete/{id}' , [FqaController::class , 'soft_delete'])->name('admin.faq.soft_delete');
        Route::get('/restore/{id}' , [FqaController::class , 'restore'])->name('admin.faq.restore');
        Route::get('/destroy/{id}' , [FqaController::class , 'destroy'])->name('admin.faq.destroy');
    });

        
    



    // start users
    Route::prefix('users')->group(function (){
        Route::get('/' , [UserController::class , 'index'])->name('admin.users.index');
        Route::get('/create' , [UserController::class , 'create'])->name('admin.users.add');
        Route::post('/store' , [UserController::class , 'store'])->name('admin.users.store');
        Route::get('/edit/{id}' , [UserController::class , 'edit'])->name('admin.users.edit');
        Route::post('/update/{id}' , [UserController::class , 'update'])->name('admin.users.update');
        Route::get('/soft_delete/{id}' , [UserController::class , 'soft_delete'])->name('admin.users.soft_delete');
        Route::get('/restore/{id}' , [UserController::class , 'restore'])->name('admin.users.restore');
        Route::get('/destroy/{id}' , [UserController::class , 'destroy'])->name('admin.users.destroy');

    });



    Route::prefix('delivery')->group(function(){
        Route::get('/' ,[DeliveryController::class , 'index'])->name('admin.delivery.index');
        Route::get('/create' ,[DeliveryController::class , 'create'])->name('admin.delivery.add');
        Route::post('/store' , [DeliveryController::class , 'store'])->name('admin.delivery.store');
        Route::get('/edit/{id}' , [DeliveryController::class , 'edit'])->name('admin.delivery.edit');
        Route::post('/update/{id}' , [DeliveryController::class , 'update'])->name('admin.delivery.update');
        Route::get('/soft_delete/{id}' , [DeliveryController::class , 'soft_delete'])->name('admin.delivery.soft_delete');
        Route::get('/restore/{id}' , [DeliveryController::class , 'restore'])->name('admin.delivery.restore');
        Route::get('/destroy/{id}' , [DeliveryController::class , 'destroy'])->name('admin.delivery.destroy');
    });


    Route::prefix('our-works')->group(function (){
        Route::get('/' , [OurworkController::class , 'index'])->name('admin.our_works.index');
        Route::get('/create' , [OurworkController::class , 'create'])->name('admin.our_works.add');
        Route::get('/edit/{id}' , [OurworkController::class , 'edit'])->name('admin.our_works.edit');
        Route::post('/store' , [OurworkController::class , 'store'])->name('admin.our_works.store');
        Route::post('/update/{id}' , [OurworkController::class , 'update'])->name('admin.our_works.update');
        Route::get('/soft_delete/{id}' , [OurworkController::class , 'soft_delete'])->name('admin.our_works.soft_delete');
        Route::get('/restore/{id}' , [OurworkController::class , 'restore'])->name('admin.our_works.restore');
        Route::get('/destroy/{id}' , [OurworkController::class , 'destroy'])->name('admin.our_works.destroy');
    });



    // start lang

    Route::prefix('langs')->group(function (){
        Route::get('/' , [LanguageController::class , 'index'])->name('admin.lang.index');
       Route::get('/add' , [LanguageController::class , 'create'])->name('admin.lang.add');
       Route::get('/delete/{id}' , [LanguageController::class , 'delete'])->name('admin.lang.delete');
       Route::post('/store' , [LanguageController::class , 'store'])->name('admin.lang.store');
    });




    // start meta
    Route::prefix('meta')->group(function (){
        Route::get('/' , [MetaController::class , 'index'])->name('admin.meta.index');
        Route::post('/update' , [MetaController::class , 'update'])->name('admin.meta.update');
        Route::get('/products' , [MetaController::class , 'products'])->name('admin.meta.products');
        Route::get('/blogs' , [MetaController::class , 'blogs'])->name('admin.meta.blogs');
        Route::get('/services' , [MetaController::class , 'services'])->name('admin.meta.services');
        Route::get('/projects' , [MetaController::class , 'projects'])->name('admin.meta.projects');
        Route::get('/categories' , [MetaController::class , 'categories'])->name('admin.meta.categories');
        Route::post('/update/products' , [MetaController::class , 'update_products'])->name('admin.meta.update_products');
        Route::post('/update/categories' , [MetaController::class , 'update_categories'])->name('admin.meta.update_categories');
        Route::post('/update/blogs' , [MetaController::class , 'update_blogs'])->name('admin.meta.update_blogs');
        Route::post('/update/services' , [MetaController::class , 'update_services'])->name('admin.meta.update_services');
        Route::post('/update/projects' , [MetaController::class , 'update_projects'])->name('admin.meta.update_projects');

    });



    // start categories
    Route::prefix('categories')->group(function (){
        Route::get('/' , [CategoryController::class , 'index'])->name('admin.category.index');
        Route::get('/add' , [CategoryController::class , 'create'])->name('admin.category.add');
        Route::get('/edit/{id}' , [CategoryController::class , 'edit'])->name('admin.category.edit');
        Route::post('/store' , [CategoryController::class , 'store'])->name('admin.category.store');
        Route::post('/update/{id}' , [CategoryController::class , 'update'])->name('admin.category.update');
        Route::get('/soft_delete/{id}' , [CategoryController::class , 'soft_delete'])->name('admin.category.soft_delete');
        Route::get('/restore/{id}' , [CategoryController::class , 'restore'])->name('admin.category.restore');
        Route::get('/destroy/{id}' , [CategoryController::class , 'destroy'])->name('admin.category.destroy');
    });


    // start product routes

    Route::prefix('products')->group(function (){
        Route::get('/' , [ProductController::class , 'index'])->name('admin.products.index');
        Route::get('/edit/{id}' , [ProductController::class , 'edit'])->name('admin.products.edit');
        Route::get('/add' , [ProductController::class , 'create'])->name('admin.products.add');
        Route::post('/update/{id}' , [ProductController::class , 'update'])->name('admin.products.update');
        Route::post('/store' , [ProductController::class , 'store'])->name('admin.products.store');
        Route::get('/soft_delete/{id}' , [ProductController::class , 'soft_delete'])->name('admin.products.soft_delete');
        Route::get('/restore/{id}' , [ProductController::class , 'restore'])->name('admin.products.restore');
        Route::get('/destroy/{id}' , [ProductController::class , 'destroy'])->name('admin.products.destroy');

        // start add type to products
        Route::get('/add_type/{id}' ,  [ProductController::class , 'add_type'])->name('admin.products.add_type');
        Route::post('store_type' , [ProductController::class , 'store_type'])->name('admin.products.store_type');
        Route::get('destroy_type/{product_id}/{type_id}' , [ProductController::class , 'destroy_type'])->name('admin.product_type.destroy_type');



        // start extra 
        Route::get('add_extra/{id}' , [ProductController::class , 'add_extra'])->name('admin.products.add_extra');
        Route::post('store_extra' , [ProductController::class , 'store_extra'])->name('admin.products.store_extra');
        Route::get('destroy_extra/{product_id}/{extra_id}' , [ProductController::class , 'destroy_extra'])->name('admin.product_extra.destroy_extra');

        //start combo 
        Route::get('add_combo/{id}' , [ProductController::class , 'add_combo'])->name('admin.products.add_combo');
        Route::post('store_combo' , [ProductController::class , 'store_combo'])->name('admin.products.store_combo');
        Route::get('destroy_combo/{product_id}/{combo_id}' , [ProductController::class , 'destroy_combo'])->name('admin.product_combo.destroy_combo');



        // start gallary

        Route::get('/gallery/{id}' , [ProductController::class , 'gallery'])->name('admin.products.gallery');
        Route::get('/delete/{id}' , [ProductController::class , 'delete_gallery'])->name('admin.products.delete_gallery');
        Route::post('/store/{id}/gallery' , [ProductController::class , 'store_gallery'])->name('admin.products.save_gallery');
    });


    // start settings
    Route::prefix('settings')->group(function (){
        Route::get('/' , [SettingController::class , 'index'])->name('admin.settings.index');
        Route::post('/update' , [SettingController::class , 'update'])->name('admin.settings.update');
    });



    // start services
    Route::prefix('services')->group(function (){
        Route::get('/' , [ServiceController::class , 'index'])->name('admin.services.index');
        Route::get('/edit/{id}' , [ServiceController::class , 'edit'])->name('admin.services.edit');
        Route::get('/create' , [ServiceController::class , 'create'])->name('admin.services.add');
        Route::post('/store' , [ServiceController::class , 'store'])->name('admin.services.store');
        Route::post('/update/{id}' , [ServiceController::class , 'update'])->name('admin.services.update');
        Route::get('/soft_delete/{id}' , [ServiceController::class , 'soft_delete'])->name('admin.services.soft_delete');
        Route::get('/restore/{id}' , [ServiceController::class , 'restore'])->name('admin.services.restore');
        Route::get('/destroy/{id}' , [ServiceController::class , 'destroy'])->name('admin.services.destroy');


        Route::get('/gallery/{id}' , [ServiceController::class , 'gallery'])->name('admin.services.gallery');
        Route::get('/delete/{id}' , [ServiceController::class , 'delete_gallery'])->name('admin.services.delete_gallery');
        Route::post('/store/{id}/gallery' , [ServiceController::class , 'store_gallery'])->name('admin.services.save_gallery');


    });


    // route for blog cms
    Route::prefix('cms')->group(function (){
       Route::get('/' , [CMSController::class , 'index'])->name('admin.cms.index');
       Route::get('/edit/{id}' , [CMSController::class , 'edit'])->name('admin.cms.edit');
       Route::post('/update/{id}' , [CMSController::class , 'update'])->name('admin.cms.update');
       Route::get('/create' , [CMSController::class , 'create'])->name('admin.cms.add');
       Route::post('/store' , [CMSController::class , 'store'])->name('admin.cms.store');
       Route::get('/soft_delete/{id}' , [CMSController::class , 'soft_delete'])->name('admin.cms.soft_delete');
       Route::get('/restore/{id}' , [CMSController::class , 'restore'])->name('admin.cms.restore');
       Route::get('/destroy/{id}' , [CMSController::class , 'destroy'])->name('admin.cms.destroy');
    });






    // start gallery and videos and files
    Route::prefix('media')->group(function (){

        // create global media group
        Route::get('/group_media' , [MediaGroupcontroller::class , 'index'])->name('admin.group_media.index');
        Route::get('/group_media/create' , [MediaGroupcontroller::class , 'create'])->name('admin.media_group.add');
        Route::post('/group_media/store' , [MediaGroupcontroller::class , 'store'])->name('admin.group_media.store');
        Route::get('/group_media/edit/{id}' , [MediaGroupcontroller::class , 'edit'])->name('admin.group_media.edit');
        Route::post('/group_media/update/{id}' , [MediaGroupcontroller::class , 'update'])->name('admin.group_media.update');
        Route::get('/group_media/soft_delete/{id}' , [MediaGroupcontroller::class , 'soft_delete'])->name('admin.group_media.soft_delete');
        Route::get('/group_media/restore/{id}' , [MediaGroupcontroller::class , 'restore'])->name('admin.group_media.restore');
        Route::get('/group_media/destroy/{id}' , [MediaGroupcontroller::class , 'destroy'])->name('admin.group_media.destroy');


        // show all file belongs to media group 

        Route::get('/group_media/files/{id}' , [MediaGroupcontroller::class , 'show_files'])->name('admin.group_media.files');

        //images
        Route::get('/gallery' , [GalleryController::class , 'gallery'])->name('admin.media.gallery');
        Route::get('/gallery/create' , [GalleryController::class , 'create'])->name('admin.gallery.add');
        Route::get('/gallery/edit/{id}' , [GalleryController::class , 'edit'])->name('admin.gallery.edit');
        Route::post('/gallery/store' , [GalleryController::class , 'store'])->name('admin.gallery.store');
        Route::post('/gallery/update/{id}' , [GalleryController::class , 'update'])->name('admin.gallery.update');
        Route::get('/gallery/soft_delete/{id}' , [GalleryController::class , 'soft_delete'])->name('admin.gallery.soft_delete');
        Route::get('/gallery/restore/{id}' , [GalleryController::class , 'restore'])->name('admin.gallery.restore');
        Route::get('/gallery/destroy/{id}' , [GalleryController::class , 'destroy'])->name('admin.gallery.destroy');



        // videos media
        Route::get('/videos' , [VideoController::class , 'videos'])->name('admin.media.videos');
        Route::get('/videos/create' , [VideoController::class , 'create'])->name('admin.videos.add');
        Route::get('/videos/edit/{id}' , [VideoController::class , 'edit'])->name('admin.videos.edit');
        Route::post('/videos/update/{id}' , [VideoController::class , 'update'])->name('admin.videos.update');
        Route::post('/videos/store' , [VideoController::class , 'store'])->name('admin.videos.store');
        Route::get('/videos/soft_delete/{id}' , [VideoController::class , 'soft_delete'])->name('admin.videos.soft_delete');
        Route::get('/videos/restore/{id}' , [VideoController::class , 'restore'])->name('admin.videos.restore');
        Route::get('/videos/destroy/{id}' , [VideoController::class , 'destroy'])->name('admin.videos.destroy');



        // files media
        Route::get('/files' , [FileController::class , 'files'])->name('admin.media.files');
        Route::get('/files/create' , [FileController::class , 'create'])->name('admin.files.add');
        Route::get('/files/edit/{id}' , [FileController::class , 'edit'])->name('admin.files.edit');
        Route::post('/files/update/{id}' , [FileController::class , 'update'])->name('admin.files.update');
        Route::post('/files/store' , [FileController::class , 'store'])->name('admin.files.store');
        Route::get('/files/soft_delete/{id}' , [FileController::class , 'soft_delete'])->name('admin.files.soft_delete');
        Route::get('/files/restore/{id}' , [FileController::class , 'restore'])->name('admin.files.restore');
        Route::get('/files/destroy/{id}' , [FileController::class , 'destroy'])->name('admin.files.destroy');


    }); // end media files and gallery and gallery


    // route for description ( is some description or text with title )
    Route::prefix('des')->group(function (){
       Route::get('/' , [DesController::class , 'index'])->name('admin.des.index');
       Route::get('/edit/{id}' , [DesController::class , 'edit'])->name('admin.des.edit');
       Route::get('/create' , [DesController::class , 'create'])->name('admin.des.add');
       Route::post('/store' , [DesController::class , 'store'])->name('admin.des.store');
       Route::post('/update/{id}' , [DesController::class , 'update'])->name('admin.des.update');
        Route::get('/soft_delete/{id}' , [DesController::class , 'soft_delete'])->name('admin.des.soft_delete');
        Route::get('/restore/{id}' , [DesController::class , 'restore'])->name('admin.des.restore');
        Route::get('/destroy/{id}' , [DesController::class , 'destroy'])->name('admin.des.destroy');

    });




    // start achievement
    Route::prefix('achievements')->group(function (){
        Route::get('/'  , [AchievementConroller::class , 'index'])->name('admin.ach.index');
        Route::post('/update'  , [AchievementConroller::class , 'update'])->name('admin.ach.update');
    });





    // start branches
    Route::prefix('branches')->group(function (){
        Route::get('/' , [BranchController::class , 'index'])->name('admin.branches.index');
        Route::get('/edit/{id}' , [BranchController::class , 'edit'])->name('admin.branches.edit');
        Route::post('/update/{id}' , [BranchController::class , 'update'])->name('admin.branches.update');
        Route::get('/create' , [BranchController::class , 'create'])->name('admin.branches.create');
        Route::post('/store' , [BranchController::class , 'store'])->name('admin.branches.store');
        Route::get('/destroy/{id}' , [BranchController::class , 'destroy'])->name('admin.cms.destroy');
     });




}); // end admin prefix



