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
        Schema::create('typeoption_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_option_id');
            $table->string('locale')->index();
            $table->unique(['type_option_id', 'locale']);
            $table->string('name');
            $table->text('des')->nullable();
            $table->foreign('type_option_id')->references('id')->on('typeoptions')->onDelete('cascade');
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
        Schema::dropIfExists('typeoption_translations');
    }
};
