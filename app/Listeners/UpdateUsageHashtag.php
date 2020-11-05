<?php

namespace App\Listeners;

use App\Events\TweetUpdated;
use App\Models\Tweet;
use App\Services\HashtagService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UpdateUsageHashtag
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
     * @param  TweetUpdated  $event
     * @return void
     */
    public function handle(TweetUpdated $event)
    {
        $oldHashtags = $event->tweet->hashtags->map(function($item){
            return $item->title;
        });

        $newHashtags = HashtagService::getHashtags($event->tweet->text);
        HashtagService::softDetach($event->tweet->id);
        foreach($oldHashtags as $item)
        {
            $hashtag = HashtagService::findOrCreate($item);
            $hashtag->usageCount--;
            $hashtag->save();
        }
        foreach($newHashtags as $item)
        {
            $hashtag = HashtagService::findOrCreate($item);
            $hashtag->tweets()->attach($event->tweet->id);
            $hashtag->usageCount++;
            $hashtag->save();
        }
    }
}
