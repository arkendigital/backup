<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;

class Setting extends Model
{
    use Rememberable;
    public $rememberCacheDriver = 'array';
    public $timestamps = false;
    public $fillable = ['key', 'value'];

    /**
     * Get a setting
     *
     * @return string
     */
    public static function get($key, $default = false)
    {
        $setting = static::where('key', $key)->remember(43200)->first();

        if (!$setting) {
            return $default;
        }

        return $setting->value;
    }

    /**
     * Set a setting
     *
     * @return void
     */
    public static function set($key, $value)
    {
        $setting = self::where('key', $key)->remember(43200)->first();
        if ($setting) {
            self::find($setting->id);
            $setting->key = $key;
            $setting->value = $value;
            self::flushCache();
            $setting->update();
        } else {
            $setting = new static();
            $setting->key = $key;
            $setting->value = $value;
            self::flushCache();
            $setting->save();
        }
    }
}
