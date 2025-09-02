<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadBookCoverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cover' => ['required', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5MB
        ];
    }
}
