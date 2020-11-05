<?php

namespace App\Listeners;

use App\Events\TweetDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DecreaseUserTweets
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TweetDeleted  $event
     * @return void
     */
    public function handle(TweetDeleted $event)
    {
        $event->user->update([
            'tweets' => DB::raw('tweets-1'),
        ]);
    }
}
