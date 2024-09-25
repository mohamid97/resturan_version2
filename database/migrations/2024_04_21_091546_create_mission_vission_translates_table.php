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
        Schema::create('mission_vission_translates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mission_vission_id');
            $table->string('locale')->index();
            $table->text('services')->nullable();
            $table->text('about')->nullable();
            $table->text('mission')->nullable();
            $table->text('vission')->nullable();
            $table->text('breif')->nullable();
            $table->unique(['mission_vission_id', 'locale']);
            $table->foreign('mission_vission_id')->references('id')->on('mission_vissions')->onDelete('cascade');
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
        Schema::dropIfExists('mission_vission_translates');
    }
};
