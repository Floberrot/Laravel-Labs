<?php

namespace App\Console\Commands;

use App\Services\PaymentGatewayInterface;
use Illuminate\Console\Command;

class PaymentCommand extends Command
{
    public function __construct(
        private PaymentGatewayInterface $gateway
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd($this->gateway);
    }
}
