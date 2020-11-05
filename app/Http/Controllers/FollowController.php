<?php

namespace App\Http\Controllers;

use App\Events\Followed;
use App\Events\UnFollowed;
use App\Http\Requests\FollowRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function follow(FollowRequest $request,$id)
    {
        $user = auth('api')->user();
        if($user->followings->contains($id))
        {
            $user->unFollow($id);
            event(new UnFollowed($user,$id));
        }
        else
        {
            $user->followings()->attach($id);
            event(new Followed($user,$id));
        }
        return response()->json(['data' => [],'errors' =>[]],200);
    }
}
