<?php

namespace Core\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
        ];
    }
}
