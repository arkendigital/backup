<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSector extends Model
{
    protected $guarded = ['id'];
    protected $fillable = ['*'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($sector) {
            Job::where('sector_id', $sector->id)
                ->update(['sector_id' => null]);
        });
    }

    public function jobs()
    {
        return $this->belongsToMany('JobSector', 'id', 'sector_id');
    }
}
