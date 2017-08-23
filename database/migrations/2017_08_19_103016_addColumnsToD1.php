<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToD1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('d1_stats', function (Blueprint $table) {
            $table->integer('total_kills', false, true)->after('kd');
            $table->integer('total_games', false, true)->after('total_kills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('d1_stats', function (Blueprint $table) {
            $table->dropColumn('total_kills');
            $table->dropColumn('total_games');
        });
    }
}