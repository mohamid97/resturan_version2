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
        Schema::create('meta_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meta_id');
            $table->string('locale')->index();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_tags')->nullable();
            $table->text('meta_des');
            $table->text('meta_title');
            $table->unique(['meta_id', 'locale']);
            $table->foreign('meta_id')->references('id')->on('metas')->onDelete('cascade');
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
        Schema::dropIfExists('meta_translations');
    }
};
