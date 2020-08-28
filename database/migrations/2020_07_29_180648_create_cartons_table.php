<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barcode', 13);

            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('carton_type_id')->unsigned();
            $table->foreign('carton_type_id')->references('id')->on('carton_types');

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
        Schema::dropIfExists('cartons');
    }
}
