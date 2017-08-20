<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
                'border_color'     => '333333',
            ],
            [
                'name'             => 'Confirmed',
                'slug'             => 'donator',
                'description'      => 'Has signed into DestinyStatus and verified account.',
                'text_color'       => '000000',
                'background_color' => 'fdff96',
                'border_color'     => 'b9bc12',
            ],
            [
                'name'             => 'Developer',
                'slug'             => 'developer',
                'description'      => 'Has supported the project via code.',
                'text_color'       => '333333',
                'background_color' => 'ff834f',
                'border_color'     => '333333',
            ],
            [
                'name'             => 'Veteran',
                'slug'             => 'veteran',
                'description'      => 'Had a least a 0.5kd or 100 raid completions in Destiny 1',
                'text_color'       => 'FFFFFF',
                'background_color' => 'a5a5a5',
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
