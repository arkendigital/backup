<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\JobClick;
use App\Models\JobApply;
use App\Models\JobEmail;

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
        "image",
        "salary_type",
        "min_salary",
        "max_salary",
        "min_daily_salary",
        "max_daily_salary",
        "location_id",
        "region_id",
        "town",
        "company_id",
        "featured",
        "apply_link",
        "status_id",
        "type",
        "experience",
        "sector_id",
        "contact_email",
        "sectors",
        "price",
        "start_date",
        "end_date",
        "sort_order"
    ];


    protected $table = 'job_vacancies';
    public $timestamps = true;

    protected $dates = ['deleted_at', 'start_date', 'end_date'];

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

    /**
    * A job has a location.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function town()
    {
        return $this->hasOne(Town::class, 'id', 'town_id');
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

        if (!request()->session()->has($cookie_name)) {

            /**
             * Create cookie
             *
             */
            request()->session()->put($cookie_name, now());

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
     * Add unique applies to the job
     *
     */
    public function trackUniqueApplies()
    {
        $cookie_name = "job_apply_" . $this->attributes["id"];
        
        /**
         * Check if unique cookie exists
         *
         */

        if (!request()->session()->has($cookie_name)) {

            /**
             * Create cookie
             *
             */
            request()->session()->put($cookie_name, now());

            /**
             * Track unique impression
             *
             */
            JobApply::create([
                "job_id" => $this->attributes["id"]
            ]);
        }
    }

    /**
     * Add unique emails to the job
     *
     */
    public function trackUniqueEmails()
    {
        $cookie_name = "job_email_" . $this->attributes["id"];
        
        /**
         * Check if unique cookie exists
         *
         */

        if (!request()->session()->has($cookie_name)) {

            /**
             * Create cookie
             *
             */
            request()->session()->put($cookie_name, now());

            /**
             * Track unique impression
             *
             */
            JobEmail::create([
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

    public function getSectorsAttribute()
    {
        return explode(",", $this->attributes["sectors"]);
    }

    public function getReadableSectorsAttribute()
    {

        $sector_ids = explode(",", $this->attributes["sectors"]);
        $sectors = "";

        foreach ($sector_ids as $id) {
            $id = str_replace(",", "", $id);

            $sector =JobSector::find($id);

            if (null !== $sector) {
             $sectors.= $sector->name . ", ";
            }
        }

        return $sectors;

    }


    public function getStartDateAttribute()
    {
      if ($this->attributes["start_date"] !== null) {
        return date("d-m-Y", strtotime($this->attributes["start_date"]));
      }
    }

    public function getEndDateAttribute()
    {
      if ($this->attributes["end_date"] !== null) {
        return date("d-m-Y", strtotime($this->attributes["end_date"]));
      }
    }
}
