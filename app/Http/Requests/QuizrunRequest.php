<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizrunRequest extends FormRequest
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
            'choice' => ['required_if:format,JtoEQ,EtoJQ'],
            'input' => ['required_if:format,FillQ'],
        ];
    }

    public function messages()
    {
        return [
            'choice.required_if' => 'Please select an answer.',
            'input.required_if' => 'Please enter the answer.',
        ];
    }
}
