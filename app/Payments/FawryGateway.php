<?php

namespace App\Payments;

use App\Models\User;
use App\Payments\Contracts\PaymentGateway;

class FawryGateway implements PaymentGateway
{
    public function __construct() {}

    public function charge(User $user, int $amountInCents): array
    {
        return [
            'status'   => 'ok',
            'provider' => 'fawry',
            'ref'      => 'FWR-'.uniqid('', true),
        ];
    }
}
