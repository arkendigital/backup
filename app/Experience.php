<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';

    /**
     * Add Experience
     *
     * @return App\Experience
     */
    public function add($points)
    {
        $this->increment('points', $points);

        return $this;
    }

    /**
     * Remove Experience
     *
     * @return App\Experience
     */
    public function remove($points)
    {
        $this->decrement('points', $points);

        return $this;
    }

    /**
     * Get the points attrbute
     *
     * @return string
     */
    public function getPointsAttribute($points)
    {
        return number_format($points);
    }
}
