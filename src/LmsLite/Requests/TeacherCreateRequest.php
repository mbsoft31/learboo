<?php

namespace Core\LmsLite\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'role' => 'nullable|string',
            'phone' => 'nullable|string',
            'imageUrl' => 'nullable|string',
            'description' => 'nullable|string',
            'user_id' => 'required|integer',
        ];
    }
}
