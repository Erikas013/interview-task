<?php

namespace App\Service\Payment;

class Swedbank
{
    public function pay(float $amount): string
    {
        return 'Swedbank payment successful!';
    }
}