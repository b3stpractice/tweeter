<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Followed' => [
            'App\Listeners\IncreaseFollowersAndFollowing',
        ],
        'App\Events\UnFollowed' => [
            'App\Listeners\DecreaseFollowersAndFollowing'
        ],
        'App\Events\Liked' => [
            'App\Listeners\IncreaseTweetLikes',
        ],
        'App\Events\UnLiked' => [
            'App\Listeners\DecreaseTweetLikes',
        ],
        'App\Events\Commented' => [
            'App\Listeners\IncreaseTweetComments',
        ],
        'App\Events\TweetCreated' => [
            'App\Listeners\IncreaseUserTweets',
            'App\Listeners\IncreaseUsageHashtag',
        ],
        'App\Events\TweetDeleted' => [
            'App\Listeners\DecreaseUserTweets',
            'App\Listeners\DecreaseUsageHashtag',
        ],
        'App\Events\TweetUpdated' => [
            'App\Listeners\UpdateUsageHashtag',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
