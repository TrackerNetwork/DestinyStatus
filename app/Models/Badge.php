<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Badge.
 *
 * @property int id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $text_color
 * @property string $background_color
 * @property string $border_color
 * @mixin \Eloquent
 */
class Badge extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'badges';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'text_color', 'background_color', 'border_color'];

    /**
     * @var bool
     */
    public $timestamps = false;

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

    public function ui()
    {
        // This is some shitty code, but no fancy HTML package like Yii2 and neither of
        // the Laravel packages have nested attribute support.

        return '<span class="badge" style="color: #'.$this->text_color.'; background-color: #'
            .$this->background_color.'; border: 1px solid #'.$this->border_color.';" data-toggle="popover" 
            data-title="'.$this->name.'" data-content="'.$this->description.'">'.$this->name.'</span>';
    }
}
