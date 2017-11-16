<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegistered' => [
            'App\Listeners\UserRegisteredListener',
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserLoggedInListener@handle',
        ],
        'App\Events\ThreadCreated' => [
            'App\Listeners\ThreadCreatedListener',
        ],
        'App\Events\ForumPostCreated' => [
            'App\Listeners\ForumPostCreatedListener',
        ],
        'App\Events\ForumPostUpdated' => [
            'App\Listeners\ForumPostUpdatedListener',
        ],
        'App\Events\ForumThreadViewed' => [
            'App\Listeners\ForumThreadViewedListener',
        ],
        // Socialite
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\Steam\SteamExtendSocialite@handle',
            'SocialiteProviders\Discord\DiscordExtendSocialite@handle',
            'SocialiteProviders\Twitch\TwitchExtendSocialite@handle',
            'SocialiteProviders\Live\LiveExtendSocialite@handle',
        ]

    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
