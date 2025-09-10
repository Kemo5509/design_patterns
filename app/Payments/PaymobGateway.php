<?php

namespace App\Payments;

use App\Models\User;
use App\Payments\Contracts\PaymentGateway;

class PaymobGateway implements PaymentGateway
{
    public function __construct(/* inject any SDK deps here */) {}

    public function charge(User $user, int $amountInCents): array
    {
        // TODO: call Paymob API here
        return [
            'status'   => 'ok',
            'provider' => 'paymob',
            'ref'      => 'PMB-'.uniqid('', true),
        ];
    }
}
