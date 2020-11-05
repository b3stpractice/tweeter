<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\JsonResponse;

class RegisterRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullName' => 'required|max:20',
            // 'email' => 'required|unique:users,email|email',
            'phone' => 'required|unique:users,phone|digits:11',
            'username' => 'required|unique:users,username|min:3|max:40',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'fullName' => 'نام کامل',
            'phone' => 'موبایل',
            'username' => 'نام کاربری',
            'password' => 'پسورد',
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
