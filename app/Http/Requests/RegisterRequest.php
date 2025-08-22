<?php

namespace App\Http\Requests;

use App\Validators\ValidateBannedNames;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class RegisterRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Le format de l’email est invalide.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'name.max' => 'identifiant trop long',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'adresse email',
            'password' => 'mot de passe',
            'name' => 'identifiant'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => $this->email ? strtolower(trim($this->email)) : null,
            'name'  => $this->name ? trim(ucfirst(strtolower($this->name))) : null,
        ]);
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }

    public function after(): array
    {
        return [
            new ValidateBannedNames($this->name),
            function (\Illuminate\Contracts\Validation\Validator $validator) {
                if (str_contains($this->email, 'icloud')) {
                    $validator->errors()->add(
                        'email',
                        'ICloud address are not supported'
                    );
                }
            }
        ];
    }

    public function passedValidation(): void
    {
        // if i want to normalize fields after validation
        $this->replace([
            'name' => strtoupper($this->name)
        ]);
    }

}
