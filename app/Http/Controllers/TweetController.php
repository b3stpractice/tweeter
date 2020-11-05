<?php

namespace App\Http\Controllers;

use App\Events\TweetCreated;
use App\Events\TweetDeleted;
use App\Events\TweetUpdated;
use App\Http\Requests\CreateTweetRequest;
use App\Http\Requests\DeleteTweetRequest;
use App\Http\Requests\UpdateTweetRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function submit(CreateTweetRequest $request)
    {
        $user = auth('api')->user();
        $tweet =  $user->tweets()->create($request->all());
        event(new TweetCreated($tweet));
        return response()->json(['data' => [],'errors' =>[]],200);
    }

    public function list(Request $request)
    {
        $user = auth('api')->user();
        $tweets = $user->tweets()->get();
        return response()->json(['data' => $tweets,'errors' =>[]],200);
    }

    public function specificById(Request $request,$tweet_id)
    {
        $tweet = Tweet::with('comments')->findOrFail($tweet_id);
        return response()->json(['data' => $tweet,'errors' =>[]],200);
    }

    public function delete(DeleteTweetRequest $request,$id)
    {
        $tweet =  Tweet::find($id);
        event(new TweetDeleted($tweet));
        $tweet->delete();
        return response()->json(['data' => [],'errors' =>[]],200);
    }

    public function update(UpdateTweetRequest $request,$id)
    {
        $tweet = Tweet::find($id);
        $tweet->text = $request->text;
        $tweet->save();
        event(new TweetUpdated($tweet));
    }
}
