<?php

namespace App\Services;

class StripeGateway implements PaymentGatewayInterface
{

    public function pay(): void
    {
        \Log::info('Stripe pay');
    }

    public function onFailed(): void
    {
        \Log::info('Stripe on failed');
    }
}
