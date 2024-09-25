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
        Schema::create('citiy_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('citiy_id');
            $table->double('price');
            $table->text('des')->nullable();
            $table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('cascade');
            $table->foreign('citiy_id')->references('id')->on('citiys')->onDelete('cascade');
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
        Schema::dropIfExists('citiy_prices');
    }
};
