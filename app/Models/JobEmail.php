<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobEmail extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "job_id",
        "created_at"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = "job_emails";

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    public function setUpdatedAt($value)
    {
        // do nothing
    }
}
