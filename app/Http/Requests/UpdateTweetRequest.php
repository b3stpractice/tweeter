<?php

namespace App\Http\Requests;

use App\Models\Tweet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\JsonResponse;

class UpdateTweetRequest extends FormRequest
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
            'text' => 'required|min:10|max:200',
        ];
    }

    public function attributes()
    {
        return [
            'text' => 'متن',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute ضرروی است',
            'max' => [
                'string' => ':attribute نباید بیشتر از  :max کاراکتر باشد.',
            ],

            'min' => [
                'string' => ' :attribute نباید کم تر از :min کاراکتر باشد.',
            ],
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        $response = new JsonResponse([
                'data' => [],
                'errors' =>  $validator->errors(),
             ], 422);

    throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
