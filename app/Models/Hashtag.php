<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hashtag extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','usageCount'];

    public function tweets()
    {
        return $this->belongsToMany(Tweet::class)
           ->whereNull('hashtag_tweet.deleted_at')
            ->withTimestamps();
    }

}
