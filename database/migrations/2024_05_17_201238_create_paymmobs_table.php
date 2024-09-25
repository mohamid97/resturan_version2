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
        Schema::create('paymmobs', function (Blueprint $table) {
            $table->id();
            $table->text('paymob_api')->nullable();
            $table->text('paymob_card_id')->nullable();
            $table->text('paymob_card_iframe')->nullable();
            $table->text('paymob_wallet_id')->nullable();
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
        Schema::dropIfExists('paymmobs');
    }
};
