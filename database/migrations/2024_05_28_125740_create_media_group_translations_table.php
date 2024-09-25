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
        Schema::create('media_group_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_group_id');
            $table->string('locale')->index();
            $table->unique(['media_group_id', 'locale']);
            $table->string('title_image')->nullable();
            $table->string('alt_image')->nullable();
            $table->text('des')->nullable();
            $table->text('small_des')->nullable();
            $table->string('title');
            $table->foreign('media_group_id')->references('id')->on('media_groups')->onDelete('cascade');
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
        Schema::dropIfExists('media_group_translations');
    }
};
