<?php

namespace Core\LmsLite\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'slug' => 'nullable|string',
            'description' => 'nullable|string',
            'imageUrl' => 'nullable|string',
            'categorySlug' => 'required|string',
            'teacher_id' => 'required|integer',
        ];
    }
}
