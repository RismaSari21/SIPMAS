<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'complaint_id' => ['required', 'exists:complaints,id'],
            'response' => ['required', 'string', 'max:2000'],
        ];
    }
}
