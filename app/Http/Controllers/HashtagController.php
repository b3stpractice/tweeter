<?php

namespace App\Http\Controllers;

use App\Models\Hashtag;
use App\Services\HashtagService;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
    public function tweets(Request $request)
    {
        $tweets = HashtagService::findOrCreate($request->title)
        ->tweets()->get();
        return response()->json(['data' => $tweets,'errors' =>[]],200);
    }

    public function trends()
    {
        $trends = Hashtag::orderBy('usageCount','DESC')->take(10)->get();
        return response()->json(['data' => $trends,'errors' =>[]],200);
    }
}
