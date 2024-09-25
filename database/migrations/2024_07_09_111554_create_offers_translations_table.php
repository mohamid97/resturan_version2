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
        Schema::create('offers_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offers_id');
            $table->string('locale')->index();
            $table->unique(['offers_id', 'locale']);
            $table->string('title');
            $table->string('small_des');
            $table->text('des');
            $table->foreign('offers_id')->references('id')->on('offers')->onDelete('cascade');
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
        Schema::dropIfExists('offers_translations');
    }
};
