<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'position', 'roles', 'legacy_id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * A Category has many Forums
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forums()
    {
        return $this->hasMany(Forum::class, 'category_id')->orderBy('position', 'asc');
    }

    /**
     * Set the Roles Attribute
     */
    public function setRolesAttribute($roles)
    {
        $this->attributes['roles'] = json_encode($roles);
    }

    /**
     * Get the Roles Attribute
     *
     * @return array
     */
    public function getRolesAttribute($roles)
    {
        return json_decode($roles, true);
    }
}
