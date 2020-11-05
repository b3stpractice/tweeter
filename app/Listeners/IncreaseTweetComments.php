<?php

namespace App\Listeners;

use App\Events\Commented;
use App\Models\Tweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class IncreaseTweetComments
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
     * @param  Commented  $event
     * @return void
     */
    public function handle(Commented $event)
    {
        Tweet::find($event->tweet_id)->update([
            'countComments' => DB::raw('countComments+1'),
        ]);
    }
}
