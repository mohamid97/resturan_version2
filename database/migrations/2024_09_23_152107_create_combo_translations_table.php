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
        Schema::create('combo_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combo_id');
            $table->string('locale')->index();
            $table->unique(['combo_id', 'locale']);
            $table->string('name');
            $table->text('des')->nullable();
            $table->foreign('combo_id')->references('id')->on('combos')->onDelete('cascade');
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
        Schema::dropIfExists('combo_translations');
    }
};
