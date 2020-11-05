<?php

namespace App\Http\Requests;

use App\Models\Tweet;
use Illuminate\Foundation\Http\FormRequest;

class DeleteTweetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $tweet = Tweet::findOrFail($this->route()->parameter('id'));
        return $tweet->user_id == auth('api')->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
