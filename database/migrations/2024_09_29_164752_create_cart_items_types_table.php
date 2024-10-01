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
        Schema::create('cart_items_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_item_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('typeoption_id');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('typeoption_id')->references('id')->on('typeoptions')->onDelete('cascade');
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
        Schema::dropIfExists('cart_items_types');
    }
};
