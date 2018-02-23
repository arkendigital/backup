<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageField extends Model {

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    "page_id",
    "type",
    "name",
    "key",
    "value"
  ];

    protected $table = 'pages_fields';
    public $timestamps = true;

}
