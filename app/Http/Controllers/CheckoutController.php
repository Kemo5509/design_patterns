<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayRequest;
use App\Payments\FawryGateway;
use App\Payments\PaymobGateway;
use App\Payments\StripeGateway;

class CheckoutController extends Controller
{
    public function payWithoutFactory(PayRequest $request)
    {
        $user   = $request->user();
        $amount = (int) round($request->input('amount') * 100);
        $prov   = $request->input('provider');

        if ($prov === 'paymob') {
            $gateway = new PaymobGateway();
        } elseif ($prov === 'stripe') {
            $gateway = new StripeGateway();
        } elseif ($prov === 'fawry') {
            $gateway = new FawryGateway();
        } else {
            abort(400, 'Unknown provider');
        }

        return response()->json($gateway->charge($user, $amount));
    }


    public function pay(PayRequest $request, PaymentFactory $factory)
    {
        $user    = $request->user();
        $amount  = (int) round($request->input('amount') * 100);
        $provider= $request->input('provider');
        $country = $request->input('country');

        $gateway = $factory->make($provider);

        return response()->json($gateway->charge($user, $amount));
    }

}
