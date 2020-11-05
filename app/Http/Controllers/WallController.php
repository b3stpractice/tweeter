<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class WallController extends Controller
{
    public function wall()
    {
         $tweets = Tweet::all();
         return response()->json(['data' => $tweets,'errors' =>[]],200);
    }
}
