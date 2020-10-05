<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->primary('id');
            
            $table->string('user')->unique();
            $table->string('full_name');
            $table->string('password');
            $table->string('identity_number',15)->nullable();
            $table->string('role')->nullable();

            $table->bigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
