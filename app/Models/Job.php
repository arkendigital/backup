<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model {

  use SoftDeletes;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    "title",
    "slug",
    "excerpt",
    "content",
    "salary",
    "location_id",
    "company_id",
    "featured",
    "apply_link"
  ];



    protected $table = 'job_vacancies';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

  /**
  * Return the sluggable configuration array for this model.
  *
  * @return array
  */
  public function sluggable() {
    return [
      'slug' => [
        'source' => 'title',
      ],
    ];
  }

  /**
  * Get the route key name
  */
  public function getRouteKeyName() {
    return 'slug';
  }



    /**
    * A job has a company.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function company() {
      return $this->hasOne(JobCompany::class, 'id', 'company_id');
    }

    /**
    * A job has a location.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function location() {
      return $this->hasOne(JobLocation::class, 'id', 'location_id');
    }

    public function sector() {
        return $this->hasOne(JobSector::class, 'id', 'sector_id');
    }

}
