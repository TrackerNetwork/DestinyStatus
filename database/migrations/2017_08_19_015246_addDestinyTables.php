<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestinyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('slug', 32);
            $table->string('membership_id', 32);
            $table->tinyInteger('membership_type');
            $table->timestamps();
        });

        Schema::create('d1_stats', function (Blueprint $table) {
            $table->integer('account_id', false, true)->unique();

            $table->mediumInteger('raid_completions');
            $table->integer('playtime');
            $table->float('kd', 5, 2);
            $table->integer('grimoire');

            $table->timestamps();

            $table
                ->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d1_stats');
        Schema::dropIfExists('accounts');
    }
}