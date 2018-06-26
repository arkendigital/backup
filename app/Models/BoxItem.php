<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoxItem extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  *
  */
    protected $fillable = [
        "group_id",
        "title",
        "link",
        "order",
        "external"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'box_items';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * A box item has a group.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function group()
    {
        return $this->hasOne(BoxGroup::class, 'id', 'group_id');
    }
}
