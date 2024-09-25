<?php

use App\Http\Controllers\Front\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
 return redirect()->route('admin.index');
});


// Route::get('/', [HomeController::class , 'index'])->name('home');

// Route::get('/about' , [FrontendController::class , 'about'])->name('about');
// Route::get('/contact-us' , [FrontendController::class , 'contact'])->name('contact');
// Route::get('/services' , [FrontendController::class , 'services'])->name('services');
// Route::get('/service/{slug}' , [FrontendController::class, 'service_details'])->name('service_details');
// Route::get('/get-services' , [FrontendController::class, 'get_service_category']);
// Route::get('/projects' , [FrontendController::class, 'projects'])->name('projects');
// Route::get('/blog' , [FrontendController::class, 'blog'])->name('blog');
// Route::get('/latest_blog' , [FrontendController::class, 'latest_blog'])->name('latest_blog');
// Route::get('/blog/{slug}' , [FrontendController::class, 'blog_details'])->name('blog_details');





// // messsages from contacts 

// Route::post('/send/message' , [FrontendController::class, 'message'])->name('send.contact');


// payments
// Route::get('/pay' , function(){
//     return view('front.payments.index');
// });



// paypal  // used require srmklive/paypal:~3.0

// Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
// Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
// Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
// Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');