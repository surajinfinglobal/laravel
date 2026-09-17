<?php

use App\Models\Invoice;
use App\Models\User;

it('loads the invoice page from the database when session data is missing', function () {
    $user = User::factory()->create();

    Invoice::create([
        'user_id' => $user->id,
        'invoice_number' => 'INV-TEST-001',
        'plan' => 'pro',
        'billing' => 'monthly',
        'amount' => 12,
        'payment_method' => 'stripe',
        'status' => 'paid',
        'stripe_session_id' => 'sess_test_123',
        'stripe_payment_intent' => 'pi_test_123',
        'paid_at' => now(),
    ]);

    $this->actingAs($user)
        ->get('/payment/invoiceINV-TEST-001')
        ->assertOk()
        ->assertSee('Payment Invoice')
        ->assertSee('INV-TEST-001');
});
