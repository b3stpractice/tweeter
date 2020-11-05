<?php

namespace App\Http\Controllers;

use App\Events\Liked;
use App\Events\UnLiked;
use App\Http\Requests\LikeRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function like(LikeRequest $request,$id)
    {
        $user = auth('api')->user();
        if($user->likedPosts->contains($id))
        {
            $user->unLike($id);
            event(new UnLiked($rid));
        }
        else
        {
            $user->likedPosts()->attach($id);
            event(new Liked($id));
        }
        return response()->json(['data' => [],'errors' =>[]],200);
    }

    public function likes(LikeRequest $request,$id)
    {
        $tweet = Tweet::find($id);
        $likes = $tweet->likes()->get();
        return response()->json(['data' => $likes,'errors' =>[]],200);
    }

}
