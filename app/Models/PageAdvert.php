<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageAdvert extends Model
{
    protected $fillable = [
        "page_id",
        "advert_id",
        "slug"
    ];

    protected $table = 'pages_adverts';
    
    public $timestamps = true;

    /**
    * A page has one section attached to it.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function advert()
    {
        return $this->hasOne(Advert::class, 'id', 'advert_id');
    }
}
