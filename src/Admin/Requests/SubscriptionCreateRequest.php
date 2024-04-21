<?php

namespace Core\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionCreateRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:subscriptions,email',
        ];
    }
}
