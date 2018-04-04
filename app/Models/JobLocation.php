<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobLocation extends Model {

  protected $table = 'job_locations';

  public $timestamps = true;

  protected static function boot()
  {
    parent::boot();

    static::deleting(function($location)
    {
      Job::where('location_id', $location->id)
        ->update(['location_id' => null]);
    });
  }

}
