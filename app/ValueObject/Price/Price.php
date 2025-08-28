<?php

namespace App\ValueObject\Price;

use App\Enums\CurrencyEnum;
use Illuminate\Contracts\Database\Eloquent\Castable;

class Price implements Castable
{
    public function __construct(
        public float        $amount,
        public CurrencyEnum $currency
    )
    {
    }

    public static function castUsing(array $arguments): string
    {
        return AsPrice::class;
    }
}
