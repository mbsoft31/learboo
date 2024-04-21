<?php

namespace Core\LmsLite\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'courseId' => 'required|integer',
            'categorySlug' => 'required|string',
        ];
    }
}
