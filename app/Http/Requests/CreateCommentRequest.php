<?php

namespace App\Http\Requests;

use App\Models\Tweet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\JsonResponse;

class CreateCommentRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Tweet::find($this->route('id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => 'required|max:100',
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
