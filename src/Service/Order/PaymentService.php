<?php

namespace App\Service\Order;

use App\Service\Payment\Seb;
use App\Service\Payment\Swedbank;

class PaymentService
{
    private Swedbank|Seb|null $paymentProvider = null;

    public function pay(float $amount): string
    {
        if ($this->paymentProvider) {
            return $this->paymentProvider->pay($amount);
        }

        return 'No payment provider set';
    }
    public function setPaymentProvider(Seb|Swedbank $paymentProvider): void
    {
        $this->paymentProvider = $paymentProvider;
    }
}