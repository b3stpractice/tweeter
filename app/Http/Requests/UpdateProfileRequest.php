<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\JsonResponse;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fullName' => 'required|max:20',
            // 'email' => 'required|unique:users,email|email',
            'phone' => 'sometimes|required|unique:users,phone|digits:11',
            'username' => 'sometimes|required|unique:users,username|min:3|max:40'
        ];
    }

    public function attributes()
    {
        return [
            'fullName' => 'نام کامل',
            'phone' => 'موبایل',
            'username' => 'نام کاربری'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute ضرروی است',
            'max' => [
                'string' => ':attribute نباید بیشتر از  :max کاراکتر باشد.',
            ],
            'unique' => 'ابن :attribute قبلا استفاده شده.',
            'email' => 'آدرس ایمیل معتبر نیست',
            'min' => [
                'string' => ' :attribute نباید کم تر از :min کاراکتر باشد.',
            ],
            'confirmed' => ':attribute ها با هم مطابقیت ندارند',
            'digits' => ':attribute باید :digits رقمی باشد'
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
