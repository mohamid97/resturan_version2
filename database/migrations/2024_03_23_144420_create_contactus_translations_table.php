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
        Schema::create('contactus_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_id');
            $table->string('locale')->index();
            $table->unique(['contact_id', 'locale']);
            $table->text('des')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('name');
            $table->text('meta_title')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('alt_image')->nullable();
            $table->string('title_image')->nullable();
            $table->foreign('contact_id')->references('id')->on('contactuses')->onDelete('cascade');
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
        Schema::dropIfExists('contactus_translations');
    }
};
