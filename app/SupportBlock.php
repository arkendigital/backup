<?php

namespace App;

use App\SupportBlockItem;
use Illuminate\Database\Eloquent\Model;

class SupportBlock extends Model
{
	public $fillable = ['title','subtitle','image'];

    public function items()
    {
        return $this->hasMany(SupportBlockItem::class);
    }
}
