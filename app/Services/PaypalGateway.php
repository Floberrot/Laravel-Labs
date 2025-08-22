<?php

namespace App\Services;

class PaypalGateway implements PaymentGatewayInterface
{

    public function pay(): void
    {
        \Log::info('Paypal pay');
    }

    public function onFailed(): void
    {
        \Log::info('Paypal on failed');
    }
}
