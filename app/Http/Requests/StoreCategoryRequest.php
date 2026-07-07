<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'category_name' => ['required', 'string', 'max:100', 'unique:categories,category_name'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
