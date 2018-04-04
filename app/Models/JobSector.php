<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSector extends Model
{
    protected $guarded = ['id'];

    public function jobs()
    {
        return $this->belongsToMany('JobSector', 'id', 'sector_id');
    }

}
