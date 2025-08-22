<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Validator;

class ValidateBannedNames
{
    private const array BANNED_NAMES = ["Florian", "Flo"];
    public function __construct(
        private readonly string $name
    )
    {
    }

    public function __invoke(Validator $validator): void
    {
        if (in_array($this->name, self::BANNED_NAMES)) {
            $validator->errors()->add(
                'name',
                'The sent name is a banned name, this is the list of banned names : ' . implode(', ', self::BANNED_NAMES)
            );
        }
    }
}
