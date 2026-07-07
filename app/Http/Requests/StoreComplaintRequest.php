<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'province_id' => ['required', 'string', 'max:20'],
            'province_name' => ['required', 'string', 'max:100'],
            'regency_id' => ['required', 'string', 'max:20'],
            'regency_name' => ['required', 'string', 'max:100'],
            'district_id' => ['required', 'string', 'max:20'],
            'district_name' => ['required', 'string', 'max:100'],
            'village_id' => ['required', 'string', 'max:20'],
            'village_name' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'min:10'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'address' => ['required', 'string', 'max:1000'],
            'latitude' => ['required', 'numeric', 'between:-11,6'],
            'longitude' => ['required', 'numeric', 'between:95,142'],
            'complaint_date' => ['required', 'date', 'before_or_equal:today'],
        ];
    }
}
