<?php

namespace App\Listeners;

use App\Events\Followed;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class IncreaseFollowersAndFollowing
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
     * @param  Followed  $event
     * @return void
     */
    public function handle(Followed $event)
    {
        $event->user->update([
            'following' => DB::raw('following+1'),
        ]);
        User::find($event->follow_id)->update([
            'followers' => DB::raw('followers+1'),
        ]);
    }
}
