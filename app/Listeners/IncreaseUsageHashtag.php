<?php

namespace App\Listeners;

use App\Events\TweetCreated;
use App\Models\Hashtag;
use App\Services\HashtagService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseUsageHashtag
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  TweetCreated  $event
     * @return void
     */
    public function handle(TweetCreated $event)
    {
        $hashtags = HashtagService::getHashtags($event->tweet->text);
        foreach($hashtags as $item)
        {
            $hashtag = HashtagService::findOrCreate($item);
            $hashtag->tweets()->attach($event->tweet->id);
            $hashtag->usageCount++;
            $hashtag->save();
        }
    }
}
