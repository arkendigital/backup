<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertUniqueImpression extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    "advert_id",
		"created_at"
  ];

  /**
  * Indicates which table this model relates to.
  *
  * @var string
  *
  */
  protected $table = "adverts_unique_impressions";

  /**
  * Indicates if the model should be timestamped.
  *
  * @var bool
  *
  */
  public $timestamps = true;

	public function setUpdatedAt($value)
	{
	    // do nothing
	}
}
