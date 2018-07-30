<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\JobClick;

class Job extends Model
{
    use SoftDeletes, Sluggable;

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
        "salary_type",
        "salary",
        "daily_salary",
        "location_id",
        "region_id",
        "company_id",
        "featured",
        "apply_link",
        "status_id",
        "type",
        "experience",
        "sector_id"
    ];


    protected $table = 'job_vacancies';
    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
    * Return the sluggable configuration array for this model.
    *
    * @return array
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
    * Get the route key name
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    /**
    * A job has a company.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function company()
    {
        return $this->hasOne(JobCompany::class, 'id', 'company_id');
    }

    /**
    * A job has a location.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function location()
    {
        return $this->hasOne(JobLocation::class, 'id', 'location_id');
    }

    public function sector()
    {
        return $this->hasOne(JobSector::class, 'id', 'sector_id');
    }

    public function status()
    {
        return $this->hasOne(JobStatus::class, 'id', 'status_id');
    }


    /**
     * Add impression for a job
     *
     */
    public function trackImpression()
    {

      JobImpression::create([
        "job_id" => $this->attributes["id"]
      ]);

    }

    /**
     * Add unique impression to job
     *
     */
    public function trackUniqueImpression()
    {

      $cookie_name = "job_" . $this->attributes["id"];

      /**
       * Check if unique cookie exists
       *
       */
      if (null === request()->cookie($cookie_name)) {

        /**
         * Create cookie
         *
         */
        \Cookie::queue($cookie_name, now(), 43200);

        /**
         * Track unique impression
         *
         */
        JobUniqueImpression::create([
          "job_id" => $this->attributes["id"]
        ]);

      }

    }

    /**
     * Add click to advert
     *
     */
    public function trackClick()
    {

      JobClick::create([
        "job_id" => $this->attributes["id"]
      ]);

    }

    /**
     * Get tracking url attribute
     *
     */
    public function getTrackingUrlAttribute()
    {
      $job_id = $this->attributes["id"];
      $tracking_url = env("APP_URL") . "/track/job?id=$job_id";

      return $tracking_url;
    }
}
