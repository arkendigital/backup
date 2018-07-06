<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AdvertImpression;
use App\Models\AdvertUniqueImpression;
use App\Models\AdvertClick;

class Advert extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "name",
        "url",
        "image_path",
        "type",
        "tenancy_price",
        "cpc",
        "start_date",
        "end_date",
        "active"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'adverts';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * The attributes that should be cast to carbon instances.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    /**
     * An advert has a metric attached
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function metric()
    {
      return $this->hasOne(AdvertMetric::class, "advert_id", "id");
    }

    /**
     * Add impression to advert
     *
     */
    public function trackImpression()
    {

      AdvertImpression::create([
        "advert_id" => $this->attributes["id"]
      ]);

    }

    /**
     * Add unique impression to advert
     *
     */
    public function trackUniqueImpression()
    {

      $cookie_name = "ad_" . $this->attributes["id"];

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
        AdvertUniqueImpression::create([
          "advert_id" => $this->attributes["id"]
        ]);

      }

    }

    /**
     * Add click to advert
     *
     */
    public function trackClick()
    {

      AdvertClick::create([
        "advert_id" => $this->attributes["id"]
      ]);

    }

    /**
     * Get tracking url attribute
     *
     */
    public function getTrackingUrlAttribute()
    {
      $advert_id = $this->attributes["id"];
      $url = $this->attributes["url"];
      $tracking_url = env("APP_URL") . "/track?id=$advert_id&url=$url";

      return $tracking_url;
    }

    /**
    * Get the avatar attribute
    *
    * @return string
    */
    public function getImageAttribute()
    {
        if ($this->image_path != "") {
            return env("S3_URL") . $this->image_path;
        }
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
