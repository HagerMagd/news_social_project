<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:500','unique:posts,title'],
            'desc' => ['required', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'comment_able' => ['in:on,off'],
            'images' => ['required'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp,gif|max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please Enter The Title',
            'desc.required' => 'Please Enter The Post',
            'category_id.required' => 'Please Enter The category',
            'comment_able.required' => 'Please choose The comment able ',
            'images.required' => 'Please Enter post image',

        ];
    }
}
