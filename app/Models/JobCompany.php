<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCompany extends Model {

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    "name",
    "logo_path",
    "description"
  ];



    protected $table = 'job_companies';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];



  /**
  * Get the avatar attribute
  *
  * @return string
  */
  public function getLogoAttribute() {
    if (!$this->logo_path) {
      return "https://statewideguttercompany.com/wp-content/uploads/2012/07/logo-placeholder.jpg";
    }
    return env("S3_URL") . $this->logo_path;
  }

}
