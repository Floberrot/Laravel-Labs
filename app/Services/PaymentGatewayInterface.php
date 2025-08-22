<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    public function pay(): void;

    public function onFailed(): void;
}
