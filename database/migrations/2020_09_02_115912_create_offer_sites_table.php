<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_sites', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('offer_header_id')->unsigned();
            $table->foreign('offer_header_id')->references('id')->on('offer_headers');

            $table->bigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');

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
        Schema::dropIfExists('offer_sites');
    }
}
