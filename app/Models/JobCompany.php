<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCompany extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "name",
        "logo_path",
        "description",
        "type"
    ];

    protected $table = 'job_companies';

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
    * Get the avatar attribute
    *
    * @return string
    */
    public function getLogoAttribute()
    {
        if (!$this->logo_path) {
            // return "https://statewideguttercompany.com/wp-content/uploads/2012/07/logo-placeholder.jpg";
            return "";
        }
        return env("LOCAL_URL") . $this->logo_path;
    }
}
