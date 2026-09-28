<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_tracking_page_renders(): void
    {
        $this->get(route('tracking-order'))
            ->assertOk()
            ->assertSee('Bestellung verfolgen', false)
            ->assertSee('Order ID', false)
            ->assertSee('Track', false);
    }

    public function test_tracking_finds_order_by_reference_and_email(): void
    {
        $order = Order::factory()->create([
            'reference' => 'TRACK123',
            'email' => 'buyer@example.com',
            'status' => 'pending',
            'total' => 199.5,
        ]);

        $this->get(route('tracking-order', [
            'order_id' => 'TRACK123',
            'email' => 'buyer@example.com',
        ]))
            ->assertOk()
            ->assertSee('Bestellung TRACK123', false)
            ->assertSee('buyer@example.com', false)
            ->assertSee((string) $order->reference, false);
    }

    public function test_tracking_shows_not_found_for_unknown_order(): void
    {
        $this->get(route('tracking-order', [
            'order_id' => 'MISSING',
            'email' => 'nobody@example.com',
        ]))
            ->assertOk()
            ->assertSee('Keine Bestellung', false);
    }

    public function test_contact_and_help_center_pages_render(): void
    {
        $this->get(route('help-center'))->assertOk()->assertSee('How can we help you?', false);
        $this->get(route('contact'))->assertOk()->assertSee('Kontaktieren Sie uns', false);
        $this->get(route('login'))->assertOk()->assertSee('Sign in', false);
    }
}
