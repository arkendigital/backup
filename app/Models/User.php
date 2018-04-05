<?php

namespace App\Models;

use Cache;
use Carbon\Carbon;
use App\Jobs\SendVerificationEmail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Events\Registered;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Messagable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      "username",
      "avatar_path",
      "phone_number",
      'email',
      'password',
      'email_token',
      'role_id',
      'verified',
      'api_token',
      'banned',
      'disabled',
      'provider',
      'provider_id',
      'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The attributes that should be cast to carbon instances.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $appends = ['icon'];

    /**
     * A user has a profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * A user has many articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * A user has many forum posts.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forumposts()
    {
        return $this->hasMany(ForumPost::class, 'user_id', 'id');
    }

    /**
     * A user has many forum threads.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forumthreads()
    {
        return $this->hasMany(ForumThread::class, 'user_id', 'id');
    }

    /**
     * A user has many forum threads subscriptions
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threadsubscriptions()
    {
        return $this->hasMany(ForumThreadSubscription::class, 'user_id', 'id');
    }

    /**
     * Get the forum icon attribute
     *
     * @return string
     */
    public function getIconAttribute()
    {
        if ($this->provider) {
            return '<i class="fa fa-'.$this->provider.'"></i>';
        }
    }

    /**
     * Is the current user an administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        if ($this->hasRole('Super Administrator|Administrator')) {
            return true;
        }
        return false;
    }



    /**
    * Get the avatar attribute
    *
    * @return string
    */
    public function getAvatarAttribute()
    {
        if (!$this->avatar_path) {
            return asset("images/defaults/avatar_default.jpg");
        }
        // return asset('storage/'. $this->avatar_path);
        return env("S3_URL") . $this->avatar_path;
    }
}
