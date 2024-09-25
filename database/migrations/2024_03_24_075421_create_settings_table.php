<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('home_breadcrumb_background')->nullable();
            $table->string('contact_breadcrumb_background')->nullable();
            $table->string('about_breadcrumb_background')->nullable();
            $table->string('products_breadcrumb_background')->nullable();
            $table->string('categories_breadcrumb_background')->nullable();
            $table->string('services_breadcrumb_background')->nullable();
            $table->string('our_work_breadcrumb_background')->nullable();
            $table->string('blog_breadcrumb_background')->nullable();
            $table->string('blog_details_breadcrumb_background')->nullable();
            $table->string('category_details_breadcrumb_background')->nullable();
            $table->string('service_details_breadcrumb_background')->nullable();
            $table->enum('finish' , [0,1])->default(0);
            $table->string('media' )->nullable();
            $table->string('cms' )->nullable();
            $table->string('services' )->nullable();
            $table->string('products' )->nullable();
            $table->string('categories' )->nullable();
            $table->string('our_works' )->nullable();
            $table->string('clients' )->nullable();
            $table->string('social_media' )->nullable();
            $table->string('contact_us' )->nullable();
            $table->string('about_us' )->nullable();
            $table->string('slider' )->nullable();
            $table->string('des' )->nullable();
            $table->string('achievement')->nullable();
            $table->string('mission_vission')->nullable();
            $table->string('payments')->nullable();
            $table->string('faq')->nullable();
            $table->string('feedback')->nullable();
            $table->string('offers')->nullable();
            $table->string('carts')->nullable();
            $table->string('city_price')->nullable();
            $table->string('orders')->nullable();
            $table->string('coupons')->nullable();
            $table->string('points')->nullable();
            $table->string('delivery')->nullable();
            $table->string('types')->nullable();
            $table->string('extras')->nullable();
            $table->string('combos')->nullable();
            $table->string('branches')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
