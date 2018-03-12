<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model {

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    "name",
    "slug"
  ];

  /**
  * The attributes that should be cast to carbon instances.
  *
  * @var array
  */
  protected $table = 'widgets';

}
