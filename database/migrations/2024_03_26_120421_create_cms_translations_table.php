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
        Schema::create('cms_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cms_id');
            $table->string('locale')->index();
            $table->unique(['cms_id', 'locale']);
            $table->string('name');
            $table->string('slug');
            $table->text('small_des')->nullable();
            $table->longText('des')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('alt_image')->nullable();
            $table->text('title_image')->nullable();
            $table->foreign('cms_id')->references('id')->on('cms')->onDelete('cascade');
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
        Schema::dropIfExists('cms_translations');
    }
};
