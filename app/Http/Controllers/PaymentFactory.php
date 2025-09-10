<?php

namespace App\Http\Controllers;

use App\Payments\Contracts\PaymentGateway;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class PaymentFactory
{

    public function __construct(protected Container $container) {}

    /**
     * @throws BindingResolutionException
     */
    public function make(?string $provider = null): PaymentGateway
    {
        if ($provider) {
            return $this->resolve($provider);
        }

        return $this->resolve(config('payments.default'));
    }

    /**
     * @throws BindingResolutionException
     */
    protected function resolve(string $key): PaymentGateway
    {
        $class = config("payments.providers.$key");

        if (! $class) {
            throw new InvalidArgumentException("Unknown provider [$key]");
        }

        return $this->container->make($class);
    }

}
