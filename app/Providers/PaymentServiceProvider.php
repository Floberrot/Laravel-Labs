<?php

namespace App\Providers;

use App\Console\Commands\PaymentCommand;
use App\Services\PaymentGatewayInterface;
use App\Services\PaypalGateway;
use App\Services\StripeGateway;
use Illuminate\Support\ServiceProvider;
use Psy\Util\Str;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PaymentGatewayInterface::class, StripeGateway::class);
        $this->app->when(PaymentCommand::class)
            ->needs(PaymentGatewayInterface::class)
            ->give(PaypalGateway::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
