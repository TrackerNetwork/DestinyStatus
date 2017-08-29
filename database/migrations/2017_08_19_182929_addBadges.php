<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('slug', 32);
            $table->string('description', 191);
            $table->string('text_color', 6);
            $table->string('background_color', 6);
            $table->string('border_color', 6);
        });

        $badges = [
            [
                'name'             => 'Donator',
                'slug'             => 'donator',
                'description'      => 'Wonderful supporter of DestinyStatus',
                'text_color'       => 'FFFFFF',
                'background_color' => '4286f4',
                'border_color'     => 'FFFFFF',
            ],
            [
                'name'             => 'Confirmed',
                'slug'             => 'confirmed',
                'description'      => 'Has signed into DestinyStatus and verified account.',
                'text_color'       => '000000',
                'background_color' => 'fdff96',
                'border_color'     => '000000',
            ],
            [
                'name'             => 'Developer',
                'slug'             => 'developer',
                'description'      => 'Has supported the project via code.',
                'text_color'       => '333333',
                'background_color' => 'ff834f',
                'border_color'     => '000000',
            ],
            [
                'name'             => 'Veteran',
                'slug'             => 'veteran',
                'description'      => 'Has one of the following in Destiny1: 100 raid completions, at least 0.8kd or 3500+ grimoire.',
                'text_color'       => 'e5e5e5',
                'background_color' => '000000',
                'border_color'     => 'e5e5e5',
            ],
        ];

        DB::connection()->table('badges')->insert($badges);

        Schema::create('badge_assignment', function (Blueprint $table) {
            $table->integer('account_id', false, true);
            $table->integer('badge_id', false, true);
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('badge_id')->references('id')->on('badges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badge_assignment');
        Schema::dropIfExists('badges');
    }
}
