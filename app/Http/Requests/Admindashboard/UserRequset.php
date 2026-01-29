<?php

namespace App\Http\Requests\Admindashboard;

use Illuminate\Foundation\Http\FormRequest;

class UserRequset extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required','string','min:3'],
            'user_name'=>['required','unique:users,user_name'],
            'email'=>['required','email','unique:users,email'],
            'phone'=>['required','numeric','unique:users,phone'],
            'status'=>['required','in:0,1'],
            'country'=>['required','string','min:2','max:10'],
            'city'=>['required','string','min:2','max:10'],
            'street'=>['required','string','min:2','max:10'],
            'email_verified_at'=>['required','in:0,1'],
            'password'=>['required','confirmed','min:5'],
            'password_confirmation'=>['required'],
            'image'=>['required','image','mimes:jpg,jpeg,png,webp,gif|max:2048'],

        ];
    }
}
