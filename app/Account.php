<?php

namespace App;

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
 * @property Stats $stats
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereMembershipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereMembershipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Account whereUpdatedAt($value)
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
    protected $fillable = ['name', 'membership_id', 'membership_type'];

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

    public function stats()
    {
        return $this->hasOne(Stats::class, 'account_id', 'id');
    }
}