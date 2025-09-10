<?php

return [
    'default' => env('PAYMENT_PROVIDER', 'paymob'),

    'providers' => [
        'paymob' => \App\Payments\PaymobGateway::class,
        'stripe' => \App\Payments\StripeGateway::class,
        'fawry'  => \App\Payments\FawryGateway::class,
    ],

    'country_default' => [
        'EG' => 'paymob',
        'US' => 'stripe',
        'SA' => 'fawry',
    ],
];
