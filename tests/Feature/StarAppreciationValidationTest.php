<?php

namespace Tests\Feature;

use App\Mail\StarAppreciationGiverNotValidNotification;
use App\Mail\StarAppreciationGiverValidNotification;
use App\Mail\StarAppreciationReceiverNotValidNotification;
use App\Mail\StarAppreciationReceiverValidNotification;
use App\Models\StarAppreciation;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class StarAppreciationValidationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Set up shared test state: fake mail, set admin config, and mock
     * MsGraph::isConnected() so the MsGraphAuthenticated middleware always passes.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Fake mail so nothing is actually delivered and we can assert dispatches.
        Mail::fake();

        // Make admin@example.com a recognised admin.
        Config::set('star.admins', ['admin@example.com']);

        // The MsGraphAuthenticated middleware calls MsGraph::isConnected().
        // Return true so every request passes the middleware check.
        MsGraph::shouldReceive('isConnected')
            ->andReturn(true)
            ->byDefault();
    }

    // -------------------------------------------------------------------------
    // Helper: build a valid StarAppreciation entry directly in the DB.
    // -------------------------------------------------------------------------

    private function makeEntry(array $overrides = []): StarAppreciation
    {
        return StarAppreciation::create(array_merge([
            'to_name'         => 'Jane Receiver',
            'to_email'        => 'jane@example.com',
            'from_name'       => 'Admin User',
            'from_email'      => 'admin@example.com',
            'thanks_for'      => 'Great work',
            'situation_task'  => 'Handled deployment',
            'action_results'  => 'Zero downtime',
            'situation'       => 'Handled deployment',
            'task'            => 'Handled deployment',
            'action'          => 'Zero downtime',
            'results'         => 'Zero downtime',
            'hype_note'       => 'Amazing!',
            'selected_values' => json_encode(['Excellence']),
        ], $overrides));
    }

    // -------------------------------------------------------------------------
    // Test 1: POST /star-appreciations/{id}/validate with status=valid
    //   → DB updated, two "valid" emails dispatched to correct addresses.
    // -------------------------------------------------------------------------

    public function test_validate_endpoint_with_valid_status_updates_db_and_dispatches_valid_emails(): void
    {
        $entry = $this->makeEntry();

        // Controller calls MsGraph::get('me') to identify the caller.
        MsGraph::shouldReceive('get')
            ->with('me')
            ->once()
            ->andReturn(['mail' => 'admin@example.com', 'displayName' => 'Admin User']);

        $response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->postJson("/star-appreciations/{$entry->id}/validate", ['status' => 'valid']);

        $response->assertOk()
            ->assertJson(['success' => true, 'validation_status' => 'valid']);

        // DB must be updated.
        $this->assertDatabaseHas('star_appreciations', [
            'id'                => $entry->id,
            'validation_status' => 'valid',
        ]);
        $this->assertNotNull($entry->fresh()->validated_at);

        // Exactly one giver-valid email sent to the giver.
        Mail::assertSent(
            StarAppreciationGiverValidNotification::class,
            function ($mail) use ($entry) {
                return $mail->hasTo($entry->from_email);
            }
        );

        // Exactly one receiver-valid email sent to the receiver.
        Mail::assertSent(
            StarAppreciationReceiverValidNotification::class,
            function ($mail) use ($entry) {
                return $mail->hasTo($entry->to_email);
            }
        );

        // None of the not-valid variants should have been sent.
        Mail::assertNotSent(StarAppreciationGiverNotValidNotification::class);
        Mail::assertNotSent(StarAppreciationReceiverNotValidNotification::class);
    }

    // -------------------------------------------------------------------------
    // Test 2: POST /star-appreciations/{id}/validate with status=not_valid
    //   → DB updated, two "not-valid" emails dispatched to correct addresses.
    // -------------------------------------------------------------------------

    public function test_validate_endpoint_with_not_valid_status_updates_db_and_dispatches_not_valid_emails(): void
    {
        $entry = $this->makeEntry();

        MsGraph::shouldReceive('get')
            ->with('me')
            ->once()
            ->andReturn(['mail' => 'admin@example.com', 'displayName' => 'Admin User']);

        $response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->postJson("/star-appreciations/{$entry->id}/validate", ['status' => 'not_valid']);

        $response->assertOk()
            ->assertJson(['success' => true, 'validation_status' => 'not_valid']);

        // DB must be updated.
        $this->assertDatabaseHas('star_appreciations', [
            'id'                => $entry->id,
            'validation_status' => 'not_valid',
        ]);
        $this->assertNotNull($entry->fresh()->validated_at);

        // Exactly one giver-not-valid email sent to the giver.
        Mail::assertSent(
            StarAppreciationGiverNotValidNotification::class,
            function ($mail) use ($entry) {
                return $mail->hasTo($entry->from_email);
            }
        );

        // Exactly one receiver-not-valid email sent to the receiver.
        Mail::assertSent(
            StarAppreciationReceiverNotValidNotification::class,
            function ($mail) use ($entry) {
                return $mail->hasTo($entry->to_email);
            }
        );

        // None of the valid variants should have been sent.
        Mail::assertNotSent(StarAppreciationGiverValidNotification::class);
        Mail::assertNotSent(StarAppreciationReceiverValidNotification::class);
    }

    // -------------------------------------------------------------------------
    // Test 3: POST /star-appreciations (store)
    //   → Entry created, zero emails dispatched.
    // -------------------------------------------------------------------------

    public function test_store_creates_entry_and_dispatches_no_emails(): void
    {
        // store() calls MsGraph::get('me') to populate from_name/from_email.
        MsGraph::shouldReceive('get')
            ->with('me')
            ->once()
            ->andReturn(['mail' => 'employee@example.com', 'displayName' => 'Employee User']);

        $payload = [
            'to_name'         => 'Jane Receiver',
            'thanks_for'      => 'Delivered on time',
            'situation_task'  => 'Tight deadline',
            'action_results'  => 'Shipped feature',
            'selected_values' => ['Excellence'],
        ];

        $response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->postJson('/star-appreciations', $payload);

        $response->assertOk()
            ->assertJson(['success' => true]);

        // The entry must exist in the DB.
        $this->assertDatabaseHas('star_appreciations', [
            'to_name'    => 'Jane Receiver',
            'from_email' => 'employee@example.com',
        ]);

        // No emails at all should have been dispatched on store.
        Mail::assertNothingSent();
    }

    // -------------------------------------------------------------------------
    // Test 4: Attempting to validate an already-validated entry returns 422.
    // -------------------------------------------------------------------------

    public function test_validate_endpoint_returns_422_when_entry_already_validated(): void
    {
        $entry = $this->makeEntry(['validation_status' => 'valid']);

        MsGraph::shouldReceive('get')
            ->with('me')
            ->once()
            ->andReturn(['mail' => 'admin@example.com', 'displayName' => 'Admin User']);

        $response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->postJson("/star-appreciations/{$entry->id}/validate", ['status' => 'valid']);

        $response->assertStatus(422)
            ->assertJson(['error' => 'Already validated']);

        // No emails should have been dispatched for an already-validated entry.
        Mail::assertNothingSent();
    }
}
