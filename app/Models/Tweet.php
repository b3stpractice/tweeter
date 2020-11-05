<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
       'user_id',
       'text',
       'likes',
       'comments',
    ];

    protected $appends = ['isLike','isComment'];

    public function user()
    {
        return $this->beLongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class,'likes','tweet_id','user_id')
        ->whereNull('likes.deleted_at')->withTimestamps();;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class)
           ->whereNull('hashtag_tweet.deleted_at')
           ->withTimestamps();
    }

    public function getIsLikeAttribute()
    {
        $user = auth('api')->user();
        if($user->likedPosts->contains($this->id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getIsCommentAttribute()
    {
        $user = auth('api')->user();
        if($user->comments->where('tweet_id',$this->id)->first())
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}
