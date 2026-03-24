<?php

namespace App\Http\Requests\Admindashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            "site_name" => ['required','min:2','max:60'],
            "logo" =>  ['nullable','image'],
            'logo.*' =>['mimes:jpg,jpeg,png,webp,gif|max:2048'],
            "favicon" =>['nullable','image'],
            "site_email" => ['required','email'],
            "facebook" => ['required','url'],
            'twitter' => ['required','url'],
            'youtube' => ['required','url'],
            'phone' => ['required','numeric'],
            'instagram' =>  ['required','url'],
            'country' => ['required','string','min:3','max:50'],
            'city' => ['required','string','min:3','max:50'],
            'street' => ['required','string','min:3','max:50'],
            'samll_desc' => ['required','string','min:20','max:150'],
            'status' => ['in:0,1'],
        ];
    }
}
