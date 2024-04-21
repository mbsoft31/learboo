<?php

namespace Core\LmsLite\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'parentSlug' => 'nullable|string',
        ];
    }

}
