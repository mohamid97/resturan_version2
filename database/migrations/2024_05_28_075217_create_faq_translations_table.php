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
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_id');
            $table->string('locale')->index();
            $table->unique(['faq_id', 'locale']);
            $table->string('title')->nullable();
            $table->string('title_image')->nullable();
            $table->string('alt_image')->nullable();
            $table->text('des')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->foreign('faq_id')->references('id')->on('faqs')->onDelete('cascade');
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
        Schema::dropIfExists('faq_translations');
    }
};
