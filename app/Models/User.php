<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName',
        'username',
        'following',
        'followers',
        'tweets',
        'phone',
        'password',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'email_verified_at'
    ];

    protected $appends = ['avatar','areYou','isFollow'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    protected static function boot(){
    parent::boot();

    static::creating(function ($model) {
        $model->api_token = Str::random(60);
    });
   }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }

    public function getAvatarAttribute()
    {
        return asset('/images/avatar/default.jpg');
    }

    public function getIsFollowAttribute()
    {
        $user = auth('api')->user();
          if(!$user)
          return false;
        if($user->followings->contains($this->id))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getAreYouAttribute()
    {
        $user = auth('api')->user();
        if(!$user)
          return true;
        if($user->id == $this->id)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Tweet::class,'likes','user_id','tweet_id')
        ->whereNull('likes.deleted_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function followings()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','follow_id')
        ->whereNull('followers.deleted_at');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','follow_id','follower_id')
        ->whereNull('followers.deleted_at');
    }

    public function unFollow($follow_id)
    {
        DB::table('followers')->where('follower_id' , $this->id)
        ->where('follow_id' , $follow_id)
        ->update([
             'deleted_at' => DB::raw('NOW()'),
             ]);
    }

    public function unLike($tweet_id)
    {
        DB::table('likes')->where('user_id' , $this->id)
        ->where('tweet_id' , $tweet_id)
        ->update([
            'deleted_at' => DB::raw('NOW()'),
            ]);
    }
}
