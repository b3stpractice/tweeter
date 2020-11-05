<?php

namespace App\Listeners;

use App\Events\TweetDeleted;
use App\Models\Hashtag;
use App\Services\HashtagService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecreaseUsageHashtag
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
        $hashtags = HashtagService::getHashtags($event->tweet->text);
        HashtagService::softDetach($event->tweet->id);
        foreach($hashtags as $item)
        {
            $hashtag = HashtagService::findOrCreate($item);
            $hashtag->usageCount--;
            $hashtag->save();
        }
    }
}
