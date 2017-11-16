<?php

namespace App;

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
     * Boot the User Model.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            Profile::firstOrCreate([
                'id' => $user->id,
                'user_id' => $user->id,
                'display_name' => $user->name,
                'slug' => str_slug($user->name),
            ]);

            if ($user->verified == 0) {
                if (!in_array($user->provider, ['steam'])) {
                    dispatch(new SendVerificationEmail($user));
                }
            }

            $user->xp()->updateOrCreate([]);
            $user->xp()->increment('points', 50);
        });
    }

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
     * Is the current user a member of staff.
     *
     * @return bool
     */
    public function isStaff()
    {
        if ($this->hasRole('Super Administrator|Administrator|Moderator')) {
            return true;
        }
        return false;
    }

    /**
     * Is the user online?
     *
     * @return bool
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }

    /**
     * A user has XP.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function xp()
    {
        return $this->hasOne(Experience::class, 'user_id', 'id');
    }

    /**
     * Register a user.
     *
     * @param string      $username
     * @param string      $email
     * @param string|null $password
     * @param array|null  $options  An optional array of arguments, currently only supports auto_login
     *
     * @return \App\User
     */
    public function registerUser($username, $email, $password = null, $options = [], $provider = 'default')
    {
        $password = empty($password) ? Hash::make(rand(0, 999999)) : Hash::make($password);

        // $role = Role::where('name', 'User')->first();

        $user = $this->firstOrCreate([
            'name' => $username,
            'email' => $email,
            'password' => $password,
            'api_token' => str_random(60),
            'email_token' => base64_encode($email),
            'provider' => $provider,
        ]);

        $user->assignRole('Member');

        if (is_array($options)) {
            if (isset($options['auto_login'])) {
                auth()->login($user);
            }
        }

        event(new Registered($user));

        return $user;
    }

    /**
     * Get the first letter attribute
     *
     * @return string
     */
    public function getFirstLetterAttribute()
    {
        return substr(strtoupper($this->name), 0, 1);
    }
}
