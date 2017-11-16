<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportPost extends Model
{
    protected $fillable = ['content', 'topic_id', 'user_id'];

    /**
     * A Report Post belongs to a Report Topic
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(ReportTopic::class);
    }

    /**
     * A Report Post belongs to a User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
