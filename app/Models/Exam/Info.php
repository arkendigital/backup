<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model {

  use SoftDeletes;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  *
  */
  protected $fillable = [
    "module_id",
    "name",
    "section_one_title",
    "section_one_text",
    "section_one_link",
    "section_two_title",
    "section_two_text",
    "section_two_link",
    "section_three_title",
    "section_three_text",
    "section_three_link",
    "section_four_title",
    "section_four_text",
    "section_four_link"
  ];

  /**
  * Indicates which table this model relates to.
  *
  * @var string
  *
  */
  protected $table = 'exam_modules_info';

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

}
