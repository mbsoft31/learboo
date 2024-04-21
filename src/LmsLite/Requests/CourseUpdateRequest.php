<?php

namespace Core\LmsLite\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'nullable|string',
            'imageUrl' => 'nullable|string',
            'categorySlug' => 'required|string',
            'teacherId' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ];
    }

}
