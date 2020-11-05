<?php

namespace App\Listeners;

use App\Events\Liked;
use App\Models\Tweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class IncreaseTweetLikes
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
     * @param  Liked  $event
     * @return void
     */
    public function handle(Liked $event)
    {
        Tweet::find($event->tweet_id)
        ->update([
            'countLikes'=> DB::raw('countLikes+1')
          ]);
    }
}
