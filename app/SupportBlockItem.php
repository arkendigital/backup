<?php

namespace App;

use App\SupportBlock;
use Illuminate\Database\Eloquent\Model;

class SupportBlockItem extends Model
{
	public $fillable = ['title','subtitle','image','support_block_id','support_article_id'];

    public function supportBlock()
    {
        return $this->belongsTo(SupportBlock::class);
    }
}
