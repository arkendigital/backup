<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WealthOfInformation extends Model
{
    protected $table = 'wealth_of_information';

    protected $guarded = ['id'];
    protected $fillable = ['*'];

    protected function getDataAttribute($value)
    {
        return json_decode($value);
    }

    protected function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }
}
