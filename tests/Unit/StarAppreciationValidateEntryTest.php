<?php

namespace Tests\Unit;

use App\Models\StarAppreciation;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Unit tests for StarAppreciationController::validateEntry() and store().
 *
 * These tests cover authorization, input validation, duplicate-validation
 * guards, and the mail-dispatch behaviour of store().
 */
class StarAppreciationValidateEntryTest extends TestCase
{
    use DatabaseTransactions;

    // -----------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------

    /**
     * Return a minimal set of fillable attributes for StarAppreciation.
     *
     * @param  array  $overrides
     * @return array
     */
    private function makeEntryAttributes(array $overrides = []): array
    {
        return array_merge([
            'to_name'        => 'Jane Doe',
            'to_email'       => 'jane@example.com',
            'thanks_for'     => 'Outstanding teamwork',
            'situation_task' => 'Handled a critical deployment',
            'action_results' => 'Deployed on time with zero issues',
            'selected_values'=> json_encode(['Teamwork']),
            'situation'      => 'Handled a critical deployment',
            'task'           => 'Handled a critical deployment',
            'action'         => 'Deployed on time with zero issues',
            'results'        => 'Deployed on time with zero issues',
            'hype_note'      => '',
            'from_name'      => 'John Admin',
            'from_email'     => 'john@example.com',
        ], $overrides);
    }

    /**
     * Mock MsGraph::get('me') to return the given email address.
     *
     * @param  string  $email
     * @return void
     */
    private function mockMsGraphUser(string $email): void
    {
        MsGraph::shouldReceive('get')
            ->with('me')
            ->andReturn([
                'mail'        => $email,
                'displayName' => 'Test User',
            ]);
    }

    /**
     * Also stub isConnected() so the MsGraphAuthenticated middleware passes.
     *
     * @param  string  $email
     * @return void
     */
    private function mockMsGraphUserWithConnection(string $email): void
    {
        MsGraph::shouldReceive('isConnected')
            ->andReturn(true);

        MsGraph::shouldReceive('get')
            ->with('me')
            ->andReturn([
                'mail'        => $email,
                'displayName' => 'Test User',
            ]);
    }

    // -----------------------------------------------------------------------
    // Test 1 – Non-admin user receives HTTP 403
    // -----------------------------------------------------------------------

    /**
     * A user whose email is NOT in the admin list must receive a 403 response.
     */
    public function test_non_admin_user_receives_403(): void
    {
        $entry = StarAppreciation::create($this->makeEntryAttributes());

        Config::set('star.admins', ['admin@example.com']);

        $this->mockMsGraphUserWithConnection('notanadmin@example.com');

        $response = $this->postJson(
            "/star-appreciations/{$entry->id}/validate",
            ['status' => 'valid']
        );

        $response->assertStatus(403);
        $response->assertJson(['error' => 'Unauthorized']);
    }

    // -----------------------------------------------------------------------
    // Test 2 – Non-existent entry ID receives HTTP 404
    // -----------------------------------------------------------------------

    /**
     * When the given entry ID does not exist the response must be 404.
     */
    public function test_nonexistent_entry_id_receives_404(): void
    {
        Config::set('star.admins', ['admin@example.com']);

        $this->mockMsGraphUserWithConnection('admin@example.com');

        $response = $this->postJson(
            '/star-appreciations/999999/validate',
            ['status' => 'valid']
        );

        $response->assertStatus(404);
        $response->assertJson(['error' => 'Not found']);
    }

    // -----------------------------------------------------------------------
    // Test 3 – Missing `status` parameter receives HTTP 422
    // -----------------------------------------------------------------------

    /**
     * Omitting the `status` field from the request must trigger a 422
     * validation error.
     */
    public function test_missing_status_parameter_receives_422(): void
    {
        $entry = StarAppreciation::create($this->makeEntryAttributes());

        Config::set('star.admins', ['admin@example.com']);

        $this->mockMsGraphUserWithConnection('admin@example.com');

        $response = $this->postJson(
            "/star-appreciations/{$entry->id}/validate",
            [] // no status
        );

        $response->assertStatus(422);
    }

    // -----------------------------------------------------------------------
    // Test 4 – Invalid `status` value receives HTTP 422
    // -----------------------------------------------------------------------

    /**
     * A status value that is not 'valid' or 'not_valid' must be rejected
     * with a 422 validation error.
     */
    public function test_invalid_status_value_receives_422(): void
    {
        $entry = StarAppreciation::create($this->makeEntryAttributes());

        Config::set('star.admins', ['admin@example.com']);

        $this->mockMsGraphUserWithConnection('admin@example.com');

        $response = $this->postJson(
            "/star-appreciations/{$entry->id}/validate",
            ['status' => 'maybe']
        );

        $response->assertStatus(422);
    }

    // -----------------------------------------------------------------------
    // Test 5 – Already-validated entry receives HTTP 422 with specific error
    // -----------------------------------------------------------------------

    /**
     * Attempting to validate an entry that already has a validation_status
     * set must return 422 with {error: 'Already validated'}.
     */
    public function test_already_validated_entry_receives_422_with_already_validated_error(): void
    {
        $entry = StarAppreciation::create($this->makeEntryAttributes([
            'validation_status' => 'valid',
            'validated_at'      => now(),
        ]));

        Config::set('star.admins', ['admin@example.com']);

        // Also mock Mail so no real dispatch happens during this test
        Mail::fake();

        $this->mockMsGraphUserWithConnection('admin@example.com');

        $response = $this->postJson(
            "/star-appreciations/{$entry->id}/validate",
            ['status' => 'valid']
        );

        $response->assertStatus(422);
        $response->assertJson(['error' => 'Already validated']);
    }

    // -----------------------------------------------------------------------
    // Test 6 – store() does not dispatch any mail
    // -----------------------------------------------------------------------

    /**
     * POST /star-appreciations (store) must not dispatch any mailable.
     */
    public function test_store_does_not_dispatch_any_mail(): void
    {
        Mail::fake();

        $this->mockMsGraphUserWithConnection('employee@example.com');

        $response = $this->postJson('/star-appreciations', [
            'to_name'         => 'Jane Doe',
            'thanks_for'      => 'Great teamwork',
            'situation_task'  => 'We had a tight deadline',
            'action_results'  => 'Delivered on time',
            'selected_values' => ['Teamwork'],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        Mail::assertNothingSent();
    }
}
