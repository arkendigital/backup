<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniSociety extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    *
    */
    protected $fillable = [
        "name",
        "link",
        "logo_path"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'uni_societies';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * The attributes that should be cast to carbon instances.
    *
    * @var array
    *
    */
    protected $dates = ['deleted_at'];

    /**
    * Get full URL of logo.
    *
    */
    public function getLogoAttribute()
    {
        if ($this->logo_path != "") {
            return env("LOCAL_URL") . $this->logo_path;
        } else {
            return asset("images/icons/ao-white.png");
        }
    }
}
