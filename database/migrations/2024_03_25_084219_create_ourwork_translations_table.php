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
        Schema::create('ourwork_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ourwork_id');
            $table->string('locale')->index();
            $table->unique(['ourwork_id', 'locale']);
            $table->string('name');
            $table->longText('des')->nullable();
            $table->longText('title_image')->nullable();
            $table->longText('alt_image')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_title')->nullable();
            $table->foreign('ourwork_id')->references('id')->on('ourworks')->onDelete('cascade');
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
        Schema::dropIfExists('ourwork_translations');
    }
};
