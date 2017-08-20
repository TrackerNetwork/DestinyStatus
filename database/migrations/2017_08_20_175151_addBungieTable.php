<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBungieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bungie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id', false, true)->unique();
            $table->integer('membership_id', false, true)->unique();
            $table->dateTime('first_access');
            $table->dateTime('last_update');
            $table->string('unique_name', 32);
            $table->string('display_name', 32);

            $table->text('refresh_token');
            $table->dateTime('refresh_expires');
            $table->text('access_token');
            $table->dateTime('expires');

            $table->rememberToken();

            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bungie');
    }
}
