<?php

namespace App\Models\Destiny1;

use App\Account;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account.
 *
 * @property int $account_id
 * @property int $raid_completions
 * @property int $playtime
 * @property float $kd
 * @property int $total_games
 * @property int $total_kills
 * @property int $grimoire
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \App\Account $account
 * @mixin \Eloquent
 */
class Stats extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'd1_stats';

    /**
     * @var string
     */
    protected $primaryKey = 'account_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['raid_completions', 'playtime', 'kd', 'total_games', 'total_kills', 'grimoire'];

    public static function boot()
    {
        parent::boot();
    }

    //---------------------------------------------------------------------------------
    // Accessors & Mutators
    //---------------------------------------------------------------------------------

    public function setPlaytimeAttribute($value)
    {
        $this->attributes['playtime'] = $value;
    }

    //---------------------------------------------------------------------------------
    // Public Methods
    //---------------------------------------------------------------------------------

    public function account()
    {
        return $this->belongsTo(Account::class, 'id', 'account_id');
    }
}