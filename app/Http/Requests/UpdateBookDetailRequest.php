<?php

namespace App\Http\Requests;

use App\Enums\CurrencyEnum;
use App\ISBNFormatTrait;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateBookDetailRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'isbn' => 'sometimes|string|unique:book_details,isbn',
            'pages' => 'sometimes|integer|min:0',
            'price' => ['sometimes', 'array'],
            'price.amount' => ['required_with:price', 'numeric', 'min:0'],
            'price.currency' => ['required_with:price', Rule::enum(CurrencyEnum::class)],
        ];
    }

    /**
     * @throws Exception
     */
    public function passedValidation(): void
    {
        if ($this->isbn !== null) {
            $this->merge([
                'isbn' => $this->toIsbn($this->isbn)
            ]);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
