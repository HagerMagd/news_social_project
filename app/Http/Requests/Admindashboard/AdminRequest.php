<?php

namespace App\Http\Requests\Admindashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name'=>['required','string','min:3','max:50'],
            'user_name'=>['required','string','min:3','max:30','unique:admins,user_name'],
            'status'=>['required','in:0,1'],
            'email'=>['email','required','unique:admins,email'],
            'password'=>['required'],
        ];
    }
}
