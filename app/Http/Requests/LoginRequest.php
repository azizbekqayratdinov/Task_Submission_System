<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role'=>"required",
            'email'=>"required",
            'password'=>"required|min:4|max:10"
        ];
    }
    public function messages(){
        return [
            'role.required'=>"Role saylanbadi",
            'email.required'=>"Email toltirilmadi",
            'password.required'=>"Password jazilmadi",
            'min'=>"Password minimum-4 , maximum-10 symvol boliwi kerek",
            'max'=>"Password minimum-4 , maximum-10 symvol boliwi kerek"
        ];
    }
}
