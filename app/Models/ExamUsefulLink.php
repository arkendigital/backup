<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamUsefulLink extends Model
{

    protected $table = 'exam_useful_links';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
