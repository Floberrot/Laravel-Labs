<?php

namespace App\ValueObject\Price;

use App\Enums\CurrencyEnum;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class AsPrice implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes): ?Price
    {
        if (!$value) return null;

        $data = json_decode($value, true);
        return new Price(
            amount: (float)$data['amount'],
            currency: CurrencyEnum::from($data['currency']),
        );
    }

    /**
     * @throws \JsonException
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof Price) {
            $amount = $value->amount;
            $currency = $value->currency->value;
        } elseif (is_array($value)) {
            if (!array_key_exists('amount', $value) || !array_key_exists('currency', $value)) {
                throw new InvalidArgumentException('Price array must contain amount and currency.');
            }
            $amount = (float)$value['amount'];
            $currency = $value['currency'] instanceof CurrencyEnum ? $value['currency']->value : (string)$value['currency'];
        } elseif (is_string($value)) {
            $arr = json_decode($value, true, flags: JSON_THROW_ON_ERROR);
            $amount = (float)($arr['amount'] ?? 0.0);
            $currency = (string)($arr['currency'] ?? '');
        } else {
            throw new InvalidArgumentException('Price must be a Price VO, array, string JSON or null.');
        }

        return json_encode(['amount' => $amount, 'currency' => $currency], JSON_THROW_ON_ERROR);
    }
}
