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
        $isDraft = $this->input('draft') === 'true';
        $this->merge([
            'slug' => $this->input('slug', $isDraft ? 'draft-'.uniqid() : null),
            'categorySlug' => $this->input('categorySlug', $isDraft ? 'draft' : null),
            'price' => $isDraft ? 0.00 : $this->input('price'),
            'status' => $isDraft ? 'draft' : $this->input('status'),
        ]);

        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => $isDraft ? 'nullable|string' : 'required|string',
            'imageUrl' => $isDraft ? 'nullable|string' : 'required|string',
            'categorySlug' => 'required|string',
            'teacherId' => 'required|integer',
            'price' => $isDraft ? 'nullable|numeric' : 'required|numeric',
            'status' => $isDraft ? 'nullable|string' : 'required|string',
        ];
    }
}
