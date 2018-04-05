<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
    "module_id",
    "difficulty"
  ];

    protected $table = 'survey';
    public $timestamps = true;
}
