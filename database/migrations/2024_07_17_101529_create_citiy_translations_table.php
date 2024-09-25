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
        Schema::create('citiy_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('citiy_id');
            $table->string('locale')->index();
            $table->unique(['citiy_id', 'locale']);
            $table->text('des')->nullable();
            $table->text('small_des')->nullable();
            $table->string('name');
            $table->foreign('citiy_id')->references('id')->on('citiys')->onDelete('cascade');
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
        Schema::dropIfExists('citiy_translations');
    }
};
