<?php

namespace App\Http\Requests;

use App\ISBNFormatTrait;
use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookDetailRequest extends FormRequest
{
    use ISBNFormatTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'isbn' => 'required|string|unique:book_details,isbn',
            'pages' => 'sometimes|integer|min:0'
        ];
    }

    /**
     * @throws Exception
     */
    public function passedValidation(): void
    {
        $this->merge([
            'isbn' => $this->toIsbn($this->isbn)
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
