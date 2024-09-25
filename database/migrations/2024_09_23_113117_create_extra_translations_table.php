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
        Schema::create('extra_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extra_id');
            $table->string('locale')->index();
            $table->unique(['extra_id', 'locale']);
            $table->string('name');
            $table->text('des')->nullable();
            $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
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
        Schema::dropIfExists('extra_translations');
    }
};
