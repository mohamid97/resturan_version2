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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->decimal('old_price', 8, 2)->nullable();
            $table->enum('status' , ['pending' , 'proceed', 'on way' , 'finshed' , 'canceled' , 'delivered'])->default('pending');
            $table->enum('payment_method' , ['cash' , 'paymob', 'paypal' , 'other'])->default('cash');
            $table->enum('payment_status' , ['paid' , 'unpaid'])->default('unpaid');
            $table->integer('shipping_city_id');

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
