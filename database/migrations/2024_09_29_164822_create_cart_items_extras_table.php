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
        Schema::create('cart_items_extras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_item_id');
            $table->unsignedBigInteger('extra_id');

            
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
            $table->foreign('card_item_id')->references('id')->on('card_items')->onDelete('cascade');
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
        Schema::dropIfExists('cart_items_extras');
    }
};
