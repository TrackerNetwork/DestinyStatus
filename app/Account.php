<?php

namespace App;

use App\Helpers\ConsoleHelper;
use App\Models\AssignedBadge;
use App\Models\Badge;
use App\Models\Bungie;
use App\Models\Destiny1\Stats;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $membership_id
 * @property int $membership_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $bungie_id
 * @property Stats $stats
 * @property Bungie $bungie
 * @property Badge[] $badges
 * @mixin \Eloquent
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Account extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'membership_id', 'membership_type', 'bungie_id'];

    public static function boot()
    {
        parent::boot();
    }

    //---------------------------------------------------------------------------------
    // Accessors & Mutators
    //---------------------------------------------------------------------------------

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = slug($value);
    }

    //---------------------------------------------------------------------------------
    // Public Methods
    //---------------------------------------------------------------------------------

    public function platformImage()
    {
        $platform = ConsoleHelper::getConsoleStringFromId($this->membership_type);

        return ConsoleHelper::getPlatformImage($platform);
    }

    public function url()
    {
        return route('account', [ConsoleHelper::getConsoleStringFromId($this->membership_type), $this->slug]);
    }

    public function renderBadges()
    {
        $contents = '';

        foreach ($this->badges as $badge) {
            $contents .= $badge->ui() . '&nbsp;';
        }

        return $contents;
    }

    public function stats()
    {
        return $this->hasOne(Stats::class, 'account_id', 'id');
    }

    public function badges()
    {
        return $this->hasManyThrough(Badge::class, AssignedBadge::class, 'account_id', 'id', null, 'badge_id');
    }

    public function bungie()
    {
        return $this->belongsTo(Bungie::class, 'id', 'bungie_id');
    }
}
