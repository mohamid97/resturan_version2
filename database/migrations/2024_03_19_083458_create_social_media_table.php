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
        Schema::create('social_media', function (Blueprint $table) {


            $table->id();
            $table->string('facebook')->nullable();
            $table->string('facebook_option')->nullable();
            $table->string('twitter')->nullable();
            $table->string('twitter_option' )->nullable();
            $table->string('instagram')->nullable();
            $table->string('instagram_option' )->nullable();
            $table->string('tiktok')->nullable();
            $table->string('tiktok_option' )->nullable();
            $table->string('youtube')->nullable();
            $table->string('youtube_option')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('snapchat_option')->nullable();
            $table->string('whatsup')->nullable();
            $table->string('whatsup_option' )->nullable();
            $table->string('linkedin')->nullable();
            $table->string('linkedin_option' )->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_option' )->nullable();
            $table->string('email')->nullable();
            $table->string('email_option' )->nullable();
            $table->string('skype')->nullable();
            $table->string('skype_option' )->nullable();
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
        Schema::dropIfExists('social_media');
    }
};
