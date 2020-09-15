<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Repositories extends FormRequest
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
            'name' => 'required|unique:repositories|max:255',
            'user_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'This repository has already been taken',
            'name.required' => 'The name  is required',
            'user_id.required' => 'User id is required',
        ];
    }
}
