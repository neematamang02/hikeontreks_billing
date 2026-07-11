<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\TicketPayment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_ticket_with_initial_payment(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post(route('ticket.store'), [
            'departure_date' => '2026-07-10',
            'travel_from' => 'Kathmandu',
            'travel_to' => 'Pokhara',
            'departure_location' => 'Balaju',
            'departure_time' => '07:30',
            'pickup_location' => 'New Bus Park',
            'vehicle_number' => 'BA 1 KHA 1234',
            'booked_seat' => 'A1',
            'customer_name' => 'Test Customer',
            'customer_address' => 'Kathmandu',
            'customer_email' => 'customer@example.com',
            'customer_phone' => '9800000000',
            'ticket_price' => 1500,
            'remarks' => 'Initial booking',
            'amount_paid' => 500,
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHas('success_msg');

        $this->assertDatabaseHas('tickets', [
            'customer_name' => 'Test Customer',
            'ticket_price' => '1500',
        ]);

        $this->assertDatabaseHas('ticket_payments', [
            'amount' => 500,
            'payment_method' => 'cash',
        ]);
    }

    public function test_payment_update_rejects_overpayment(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $ticket = Ticket::create([
            'departure_date' => '2026-07-10',
            'travel_from' => 'Kathmandu',
            'travel_to' => 'Pokhara',
            'departure_location' => 'Balaju',
            'departure_time' => '07:30',
            'pickup_location' => 'New Bus Park',
            'vehicle_number' => 'BA 1 KHA 1234',
            'booked_seat' => 'A1',
            'customer_name' => 'Test Customer',
            'customer_address' => 'Kathmandu',
            'customer_email' => 'customer@example.com',
            'customer_phone' => '9800000000',
            'ticket_price' => 1000,
            'remarks' => 'Initial booking',
        ]);

        $payment = TicketPayment::create([
            'ticket_id' => $ticket->id,
            'payment_method' => 'cash',
            'amount' => 400,
            'remarks' => 'First payment',
        ]);

        $response = $this->actingAs($admin)->post(route('ticket_payment.update', $payment->id), [
            'ticket_price' => 1000,
            'amount_paid' => 1200,
            'payment_method' => 'cash',
        ]);

        $response->assertSessionHas('error_msg');

        $this->assertDatabaseHas('ticket_payments', [
            'id' => $payment->id,
            'amount' => 400,
        ]);

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'ticket_price' => '1000',
        ]);
    }

    public function test_non_admin_cannot_access_user_creation_screen(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->get(route('user.create'));

        $response->assertForbidden();
    }

    public function test_non_admin_cannot_access_ticket_payment_screen(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $ticket = Ticket::create([
            'departure_date' => '2026-07-10',
            'travel_from' => 'Kathmandu',
            'travel_to' => 'Pokhara',
            'departure_location' => 'Balaju',
            'departure_time' => '07:30',
            'pickup_location' => 'New Bus Park',
            'vehicle_number' => 'BA 1 KHA 1234',
            'booked_seat' => 'A1',
            'customer_name' => 'Test Customer',
            'customer_address' => 'Kathmandu',
            'customer_email' => 'customer@example.com',
            'customer_phone' => '9800000000',
            'ticket_price' => 1000,
            'remarks' => 'Initial booking',
        ]);

        $response = $this->actingAs($user)->get(route('ticket.add_payment', $ticket->id));

        $response->assertForbidden();
    }
}