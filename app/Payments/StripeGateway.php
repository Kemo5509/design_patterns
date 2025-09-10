<?php

namespace App\Payments;

use App\Models\User;
use App\Payments\Contracts\PaymentGateway;

class StripeGateway implements PaymentGateway
{
    public function __construct(/* StripeClient $stripe */) {}

    public function charge(User $user, int $amountInCents): array
    {
        // TODO: $this->stripe->charges->create([...])
        return [
            'status'   => 'ok',
            'provider' => 'stripe',
            'ref'      => 'STP-'.uniqid('', true),
        ];
    }
}
