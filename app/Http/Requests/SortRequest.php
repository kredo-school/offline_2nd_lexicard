<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
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
    public function rules()
    {
        return [
            'other_user' => ['prohibited_if:other_user,null'],
        ];
    }

    public function messages()
    {
        return [
            'other_user.prohibited_if' => 'Please select a user.',
        ];
    }
}
