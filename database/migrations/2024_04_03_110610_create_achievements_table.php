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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('years_exp')->nullable();
            $table->string('number_of_clients')->nullable();
            $table->string('number_of_deps')->nullable();
            $table->string('number_of_products')->nullable();
            $table->string('number_of_emps')->nullable();
            $table->string('num1')->nullable();
            $table->string('num2')->nullable();
            $table->string('num3')->nullable();
            $table->string('num4')->nullable();
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
        Schema::dropIfExists('achievements');
    }
};
