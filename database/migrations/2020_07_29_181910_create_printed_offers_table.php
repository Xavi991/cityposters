<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintedOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printed_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('printed_date');

            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printed_offers');
    }
}
