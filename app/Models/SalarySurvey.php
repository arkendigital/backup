<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalarySurvey extends Model
{
    /**
     * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "type",
        "sector",
        "field",
        "experience",
        "qualifications",
        "annual_salary",
        "user_id"
    ];

    protected $table = 'salary_survery';

    public $timestamps = true;
}
