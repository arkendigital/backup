<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamUsefulLink extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "name",
        "link",
        "official"
    ];

    protected $table = 'exam_useful_links';

    public $timestamps = true;

    protected $dates = ['deleted_at'];
}
