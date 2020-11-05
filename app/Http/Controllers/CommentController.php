<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Listeners\IncreaseTweetComments;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/comment/submit",
     *     tags={"comment"},
     *     summary="Add a new comment",
     *     description="By using this api endpoint you can add a new comment per tweets",
     *     operationId="submitComment",
     *     deprecated=false,
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         description="Text values using as comment contents",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="string",
     *             maxLength=100,
     *             default="a new test comment"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid comment text value"
     *     )
     * )
     */
    public function submit(CreateCommentRequest $request,$tweet_id)
    {
        $user = auth('api')->user();
        $user->comments()->create(['tweet_id' => $tweet_id,'text' => $request->text]);
        event(new IncreaseTweetComments($tweet_id));
        return response()->json(['data' => [],'errors' =>[]],200);
    }
}
