<?php
namespace App\Services;

use App\Models\Hashtag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HashtagService{
    public static function getHashtags($tweet) : array
    {
        $pattern = "/(#\w+)/u";
        $hashtags = array();
        preg_match_all($pattern, $tweet, $matches);
        if ($matches) {
            $hashtagsArray = array_count_values($matches[0]);
            $hashtags = array_keys($hashtagsArray);
            foreach($hashtags as $key => $value)
            {
                $hashtags[$key] = substr($value,1);
            }
        }
        return $hashtags;
    }

    public static function findOrCreate($title) : Model
    {
        if($hashtag = Hashtag::where('title',$title)->first())
        {
            return $hashtag;
        }
        else
        {
           $hashtag = Hashtag::create(['title' => $title]);
           return $hashtag;
        }

    }

    public static function softDetach($tweet_id)
    {
      return DB::table('hashtag_tweet')->where('tweet_id',$tweet_id)
                 ->update(['deleted_at' => DB::raw('NOW()')]);
    }
}
