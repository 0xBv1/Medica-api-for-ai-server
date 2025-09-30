<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // Trim and strip tags to prevent XSS
        $this->merge([
            'name'    => strip_tags(trim($this->name)),
            'email'   => strip_tags(trim($this->email)),
            'phone'   => strip_tags(trim($this->phone)),
            'message' => strip_tags(trim($this->message)),
        ]);
    }

    public function rules()
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['required', 'regex:/^[0-9]{11}$/'],
            'message' => ['required', 'string', 'max:2000'],
            'hp'      => ['nullable', 'max:0'], // honeypot field must be empty
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'The phone must be exactly 10 digits.',
            'hp.max'      => 'Spam detected.',
        ];
    }
}
