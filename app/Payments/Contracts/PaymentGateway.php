<?php

namespace App\Payments\Contracts;

use App\Models\User;

interface PaymentGateway
{
    public function charge(User $user, int $amountInCents): array;

}
