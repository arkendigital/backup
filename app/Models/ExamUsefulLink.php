<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamUsefulLink extends Model {

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

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
