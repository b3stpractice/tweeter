<?php

namespace App\Listeners;

use App\Events\UnLiked;
use App\Models\Tweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DecreaseTweetLikes
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
     * @param  UnLiked  $event
     * @return void
     */
    public function handle(UnLiked $event)
    {
        Tweet::find($event->tweet_id)
        ->update([
            'countLikes'=> DB::raw('countLikes-1')
          ]);
    }
}
