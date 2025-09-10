<?php

namespace Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class PayTest extends TestCase
{
    public function test_pay_with_factory_returns_ok_response(): void
    {
        $user = User::factory()->create();

        $res = $this->actingAs($user)->postJson('/api/pay', [
            'amount'   => 45.5,
            'provider' => 'paymob',
        ]);

        $res->assertOk()
            ->assertJsonPath('provider', 'paymob')
            ->assertJsonPath('status', 'ok');
    }

    public function test_pay_with_country_uses_country_default(): void
    {
        config()->set('payments.country_default', ['US' => 'stripe']);

        $user = User::factory()->create();

        $res = $this->actingAs($user)->postJson('/api/pay', [
            'amount'  => 10,
            'country' => 'US',
        ]);

        $res->assertOk()
            ->assertJsonPath('provider', 'stripe');
    }
}
