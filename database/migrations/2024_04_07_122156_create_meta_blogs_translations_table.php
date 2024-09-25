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
        Schema::create('meta_blogs_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meta_blogs_id');
            $table->string('locale')->index();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_title')->nullable();
            $table->unique(['meta_blogs_id', 'locale']);
            $table->foreign('meta_blogs_id')->references('id')->on('meta_blogs')->onDelete('cascade');
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
        Schema::dropIfExists('meta_blogs_translations');
    }
};
