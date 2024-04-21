<?php

namespace Core\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'position' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'testimonial' => ['required', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
        ];
    }
}
