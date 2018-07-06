<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CPDResourceLink extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "resource_id",
        "title",
        "subtitle",
        "text",
        "link"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'cpd_resources_links';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;
}
