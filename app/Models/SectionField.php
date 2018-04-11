<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionField extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
    protected $fillable = [
        "section_id",
        "type",
        "name",
        "key",
        "value"
    ];

    protected $table = 'sections_fields';
    
    public $timestamps = true;
}
