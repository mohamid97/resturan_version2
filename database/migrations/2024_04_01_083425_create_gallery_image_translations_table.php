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
        Schema::create('gallery_image_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('image_id');
            $table->string('locale')->index();
            $table->unique(['image_id', 'locale']);
            $table->string('name')->nullable();
            $table->text('alt_image')->nullable();
            $table->text('title_image')->nullable();
            $table->foreign('image_id')->references('id')->on('gallery_images')->onDelete('cascade');
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
        Schema::dropIfExists('gallery_image_translations');
    }
};
