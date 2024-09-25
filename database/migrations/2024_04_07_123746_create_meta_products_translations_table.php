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
        Schema::create('meta_products_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meta_products_id');
            $table->string('locale')->index();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_title')->nullable();
            $table->unique(['meta_products_id', 'locale']);
            $table->foreign('meta_products_id')->references('id')->on('meta_products')->onDelete('cascade');
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
        Schema::dropIfExists('meta_products_translations');
    }
};
