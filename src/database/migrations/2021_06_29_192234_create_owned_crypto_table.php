<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnedCryptoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owned_crypto', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('cryptocurrency_id')->unsigned();
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrencies');

            $table->integer('wallet_id')->unsigned();
            $table->foreign('wallet_id')->references('id')->on('wallet');

            $table->float('quantity');
            $table->float('average_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owned_crypto');
    }
}
