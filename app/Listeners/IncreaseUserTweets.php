<?php

namespace App\Listeners;

use App\Events\TweetCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class IncreaseUserTweets
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
     * @param  TweetCreated  $event
     * @return void
     */
    public function handle(TweetCreated $event)
    {
        $event->user->update([
            'tweets' => DB::raw('tweets+1'),
        ]);
    }
}
