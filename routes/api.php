<?php

use App\Http\Controllers\Admin\SocialAuthController;
use App\Http\Controllers\Api\AchivementController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CmsController;
use App\Http\Controllers\Api\CouponsController;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\DescriptionController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\FeaturedApiController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\GovController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MissionVisionController;
use App\Http\Controllers\Api\OrderApiConroller;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\GovPriceController;
use App\Http\Controllers\Api\OffersController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



// start prefix version 2

 Route::prefix('V2')->group(function(){


    // start coupons
    Route::prefix('coupons')->group(function(){
        Route::get('/get' , [CouponsController::class , 'get']);
        
    });


    //offers 
    Route::prefix('offers')->group(function(){
        Route::get('/get' , [OffersController::class , 'get']);
        Route::post('/offer_details' , [OffersController::class , 'order_details']);

    });

       

    Route::prefix('sliders')->group(function (){
        Route::get('/get' , [\App\Http\Controllers\Api\SliderController::class , 'get']);
    });
    
    Route::prefix('about-us')->group(function (){
        Route::get('/get' , [\App\Http\Controllers\Api\AboutController::class , 'get']);
    });
    
    Route::prefix('category')->group(function (){
        Route::get('/get' , [\App\Http\Controllers\Api\CategoryController::class , 'get']);
        // Route::post('/details' , [\App\Http\Controllers\Api\CategoryController::class , 'get_details']);
        // Route::get('/subcategory/get' , [\App\Http\Controllers\Api\CategoryController::class , 'get_category_with_sub']);
         
    });
    
    Route::prefix('our-works')->group(function (){
        Route::get('/get' , [\App\Http\Controllers\Api\OurWorks::class , 'get']);
    });
    
    Route::prefix('social-media')->group(function (){
        Route::get('/get' , [\App\Http\Controllers\Api\SocialController::class , 'get']);
     });
     Route::prefix('langs')->group(function (){
       Route::get('/get' , [\App\Http\Controllers\Api\LangController::class , 'get']);
     });
     Route::prefix('meta')->group(function (){
         Route::get('/get' , [\App\Http\Controllers\Api\WebsiteMetaController::class , 'get']);
     });
     Route::prefix('settings')->group(function (){
        Route::get('/get' , [\App\Http\Controllers\Api\SettingsController::class , 'get']);
     });
    
     Route::prefix('contact')->group(function (){
        Route::get('/get' , [\App\Http\Controllers\Api\ContactusController::class , 'get']);
    });
    
    Route::prefix('clients')->group(function (){
       Route::get('/get'  , [\App\Http\Controllers\Api\OurClientController::class , 'get']);
    });

    Route::prefix('messages')->group(function (){
        Route::post('/store'  , [\App\Http\Controllers\Admin\MessageController::class , 'save']);
    
    });
    
    Route::prefix('faq')->group(function(){
        Route::get('/get' , [FaqController::class , 'get']);
     });



    
    // Route::prefix('services')->group(function (){
    //     Route::get('/get' , [\App\Http\Controllers\Api\ServicesController::class , 'get']);
    //     Route::post('/service_details/get' , [\App\Http\Controllers\Api\ServicesController::class , 'get_service_details']);
    //     Route::post('/service/category/get' , [\App\Http\Controllers\Api\ServicesController::class , 'service_with_category']);
    // });
    
    
    
    
    Route::prefix('products')->group(function (){
       // Route::get('get' , [\App\Http\Controllers\Api\ProductController::class , 'get']);
        Route::post('/product_details/get' , [\App\Http\Controllers\Api\ProductController::class , 'get_product_details']);
       // Route::post('category/get' , [\App\Http\Controllers\Api\ProductController::class , 'get_product_category']);
       Route::post('category/slug' , [\App\Http\Controllers\Api\ProductController::class , 'get_product_slug']);
       Route::post('/featured' , [FeaturedApiController::class , 'get']);
    
    });






    
    

 }); // end version 2 from resturant project 





//  Route::prefix('mission_vission')->group(function(){ 
//      Route::get('/get' , [MissionVisionController::class , 'get']);
//  });





    // middleware with lang

    Route::prefix('users')->group(function (){
        Route::post('/user/api_login' , [\App\Http\Controllers\Api\UsersController::class, 'Api_login']);
        Route::post('store' , [\App\Http\Controllers\Api\UsersController::class, 'store']);
        Route::prefix('delivery')->group(function(){
            // login 
            Route::post('login' , [DeliveryController::class, 'login']); 
        });
        // start rest password
        Route::post('rest_password' , [\App\Http\Controllers\Api\UsersController::class, 'rest_password']);
        Route::post('check/rest_code' , [\App\Http\Controllers\Api\UsersController::class, 'check_rest_code']);
    });

    // api for govs and cities
    Route::prefix('govs')->group(function(){
         Route::get('/all' , [GovController::class , 'all_gov']);
         Route::post('/cities/all' , [GovController::class , 'all_city']);
    });
   // Route::post('/refresh-token', [\App\Http\Controllers\Api\UsersController::class, 'refresh_token']);


   // order fees
   Route::prefix('orders')->group(function(){
    Route::post('fees' , [OrderApiConroller::class , 'fees']);
    Route::post('guest/store' , [OrderApiConroller::class , 'store_order_guest'] );
   });




   // search with categoy and product and offers general setting
   Route::prefix('search')->group(function(){
    Route::post('/general_search' , [SearchController::class , 'general_search']);
   });











Route::middleware(['auth:sanctum' , 'checkLang'])->group(function (){


    // start address of user 
    Route::prefix('user_addresses')->group(function(){
        Route::post('/all' , [UsersController::class , 'all_address']);
        Route::post('/edit' , [UsersController::class , 'edit_address']);
        Route::post('/create' , [UsersController::class , 'store_address']);
        Route::post('delete' , [UsersController::class , 'delete_address']);
        Route::post('get_address' , [UsersController::class , 'get_address']);


    });
    // start cart 
    Route::prefix('cart')->group(function(){
        Route::post('/add_item/cart' , [CartController::class , 'store']);
        Route::post('get' , [CartController::class , 'get']);
        Route::post('/update' , [CartController::class , 'update']);
        Route::post('/delete' , [CartController::class , 'delete']);
        Route::post('item/delete' , [CartController::class , 'delete_item']);

        // cart offer
        Route::post('offer_card/add' , [CartController::class , 'add_card_offer']);
        Route::post('/offer_cart/delete' , [CartController::class , 'offer_cart_delete']);
        Route::get('/offer_cart/get' , [CartController::class , 'offer_cart_get']);
    });



    // start coupons
    Route::prefix('coupons')->group(function(){
        Route::post('/coupon_details' , [CouponsController::class , 'coupon_details']);
    });

    // government price
    Route::prefix('gov_price')->group(function(){
         Route::post('get', [GovPriceController::class , 'get']);
         Route::post('cities/get' , [GovPriceController::class , 'cities']);
         Route::post('cities/price', [GovPriceController::class , 'city_price']);
    });

    // order
    Route::prefix('orders')->group(function(){
        Route::post('store' , [OrderApiConroller::class , 'store']);
        Route::post('get' , [OrderApiConroller::class , 'get']);
      

    });
    Route::prefix('users')->group(function (){
        Route::get('get' , [ \App\Http\Controllers\Api\UsersController::class, 'get']);
        Route::post('/user/get_details' , [\App\Http\Controllers\Api\UsersController::class, 'user_details']);
        Route::post('user_profile' , [\App\Http\Controllers\Api\UsersController::class, 'user_profile']);
        Route::post('user/edit' , [\App\Http\Controllers\Api\UsersController::class, 'edit_profile']);
        Route::post('logout' , [\App\Http\Controllers\Api\UsersController::class, 'logout']);
        Route::post('change_password' , [\App\Http\Controllers\Api\UsersController::class, 'change_password']);

        Route::prefix('delivery')->group(function(){
            Route::post('/on-way' ,[DeliveryController::class, 'get_on_way_order']);
            Route::post('/finished' ,[DeliveryController::class, 'get_finish_order']);
            Route::post('/cancled' ,[DeliveryController::class, 'get_canceled_order']);
            Route::post('/deliverd' ,[DeliveryController::class, 'get_delivered_order']);
            Route::post('/today' ,[DeliveryController::class, 'get_today_order']);


            Route::post('/change_status' , [DeliveryController::class, 'change_status']);

        });

        Route::post('/rest_new_password' , [DeliveryController::class, 'reset_new_password']);

        // Route::post('change_password' , );
        //Route::post('/user/api_login' , [\App\Http\Controllers\Api\UsersController::class, 'Api_login']);
    });



    Route::prefix('achivement')->group(function(){

        Route::get('/get' , [AchivementController::class , 'get']);

    });



    // start feedback api 
    Route::prefix('feedbacks')->group(function(){

         Route::get('/get' , [FeedbackController::class , 'get']);
    });


    Route::prefix('cms')->group(function(){

        Route::get('/get' , [CmsController::class , 'get']);
        Route::post('/cms_details/get' , [CmsController::class , 'get_cms_details']);

    });




    Route::prefix('mdeia')->group(function(){
        Route::get('/media-group/get' , [MediaController::class, 'get_media_group']);
    });

    Route::prefix('/statistics')->group(function(){
        Route::post('/add' , [StatisticsController::class  , 'save' ]);
    });

    Route::prefix('descriptions')->group(function(){

        Route::get('/get' , [DescriptionController::class , 'get']);
    });
    








});

