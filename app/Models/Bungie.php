<?php

namespace App\Models;

use App\Account;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Bungie.
 *
 * @property int $id
 * @property int $membership_id
 * @property Carbon $first_access
 * @property Carbon $last_update
 * @property string $unique_name
 * @property string $display_name
 * @property string $refresh_token
 * @property Carbon $refresh_expires
 * @property string $access_token
 * @property Carbon $expires
 * @property string $remember_token
 * @property int $preferred_account_id
 * @property-read Account $account
 * @property-read Account[] $accounts
 * @mixin \Eloquent
 */
class Bungie extends Model implements Authenticatable, UserProvider
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bungie';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'membership_id', 'first_access', 'last_update', 'unique_name', 'display_name',
        'refresh_token', 'refresh_expires', 'access_token', 'expires',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    public $dates = ['first_access', 'last_update', 'refresh_expires', 'expires'];

    //---------------------------------------------------------------------------------
    // Accessors & Mutators
    //---------------------------------------------------------------------------------

    public function setRefreshExpiresAttribute($value)
    {
        $this->attributes['refresh_expires'] = Carbon::now()->addSeconds($value);
    }

    public function setExpiresAttribute($value)
    {
        $this->attributes['expires'] = Carbon::now()->addSeconds($value);
    }

    public function setFirstAccessAttribute($value)
    {
        $this->attributes['first_access'] = Carbon::parse($value);
    }

    public function setLastUpdateAttribute($value)
    {
        $this->attributes['last_update'] = Carbon::parse($value);
    }

    //---------------------------------------------------------------------------------
    // Public Methods
    //---------------------------------------------------------------------------------

    public function accounts()
    {
        return $this->hasMany(Account::class, 'bungie_id', 'id');
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'id', 'preferred_account_id');
    }

    public function url() : string
    {
        return $this->account->url();
    }

    public function isActive() : bool
    {
        return $this->expires->isFuture();
    }

    public function isDonator()
    {
        $badges = $this->account->badges;

        foreach ($badges as $badge) {
            if ($badge->slug === 'donator') {
                return true;
            }
        }

        return false;
    }

    //---------------------------------------------------------------------------------
    // Auth Functions
    //---------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthPassword()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * {@inheritdoc}
     */
    public function setRememberToken($value)
    {
        $this->attributes['remember_token'] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveById($identifier)
    {
        return self::where('id', $identifier)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveByToken($identifier, $token)
    {
        return self::where('id', $identifier)->where('remember_token', $token)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveByCredentials(array $credentials)
    {
        // no auth
    }

    /**
     * {@inheritdoc}
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return false; // no auth
    }
}
