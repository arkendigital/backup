<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertMetric extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "advert_id",
        "impressions",
        "clicks"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'adverts_metrics';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = false;
}
