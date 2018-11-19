<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlMenu extends Model
{

    protected $guarded = ['id'];
    protected $with = ['links'];

    /**
     * Get a setting
     *
     * @return string
     */
    public static function getMenu($key, $default = false)
    {
        $menu = static::where('name', $key)->first();

        if (!$menu) {
            return false;
        }

        return $menu;
    }
    
    /**
     * A url menu can have many links
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany(UrlMenuLink::class, 'url_menu_id')->orderBy('order', 'asc');
    }
}
