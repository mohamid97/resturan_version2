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
        Schema::create('des_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('des_id');
            $table->string('locale')->index();
            $table->unique(['des_id', 'locale']);
            $table->string('name');
            $table->longText('des');
            $table->string('alt_image')->nullable();
            $table->string('title_image')->nullable();
            $table->foreign('des_id')->references('id')->on('des')->onDelete('cascade');

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
        Schema::dropIfExists('des_translations');
    }
};
