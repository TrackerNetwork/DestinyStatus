<?php

use App\Models\Badge;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconsToBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->string('icon', 12);
        });

        $badges = [
            [
                'slug' => 'donator',
                'icon' => 'heart'
            ],
            [
                'slug' => 'confirmed',
                'icon' => 'lock',
            ],
            [
                'slug' => 'developer',
                'icon' => 'github-alt',
            ],
            [
                'slug' => 'veteran',
                'icon' => 'bullseye'
            ]
        ];

        foreach ($badges as $badge) {
            $model = Badge::where('slug', $badge['slug'])->first();

            if ($model !== null) {
                $model->icon = $badge['icon'];
                $model->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropColumn('icon');
        });
    }
}
