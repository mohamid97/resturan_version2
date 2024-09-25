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
        Schema::create('main_faq_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_faq_id');
            $table->string('locale')->index();
            $table->unique(['main_faq_id', 'locale']);
            $table->string('title_image')->nullable();
            $table->string('alt_image')->nullable();
            $table->text('des')->nullable();
            $table->string('title');
            $table->foreign('main_faq_id')->references('id')->on('main_faqs')->onDelete('cascade');

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
        Schema::dropIfExists('main_faq_translations');
    }
};
