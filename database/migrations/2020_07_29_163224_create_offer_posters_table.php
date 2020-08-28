<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferPostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_posters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('description',255);
            $table->integer('before_price')->nullable();
            $table->integer('after_price')->nullable();
            $table->smallInteger('design_type');
            $table->smallInteger('descount_porcentage');
            $table->smallInteger('quantity_promo');
            $table->string('group');
            $table->string('group_tittle',1);

            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->foreign('product_id')->references('id')->on('products');

            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('offer_id')->references('id')->on('offers');

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
        Schema::dropIfExists('offer_posters');
    }
}
