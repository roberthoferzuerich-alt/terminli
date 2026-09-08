<?php

namespace Tests\Feature;

use App\Models\Participant;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PollTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_a_poll(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/polls', [
                'title' => 'Team Lunch',
                'description' => 'Wann gehen wir essen?',
                'options' => ['Montag 12:00', 'Dienstag 13:00'],
            ]);

        $this->assertDatabaseHas('polls', [
            'title' => 'Team Lunch',
            'user_id' => $user->id,
        ]);

        $poll = Poll::first();
        $this->assertCount(2, $poll->options);

        $response->assertRedirect('/p/'.$poll->uuid);
    }

    public function test_guest_can_view_poll_page(): void
    {
        $user = User::factory()->create();
        $poll = $user->polls()->create([
            'uuid' => 'test-uuid-123',
            'title' => 'Projekt Meeting',
        ]);
        $poll->options()->create(['label' => '10:00 Uhr']);

        $response = $this->get('/p/'.$poll->uuid);

        $response->assertOk();
        $response->assertSee('Projekt Meeting');
        $response->assertSee('10:00 Uhr');
    }

    public function test_guest_can_vote_on_poll(): void
    {
        $user = User::factory()->create();
        $poll = $user->polls()->create([
            'uuid' => 'test-uuid-456',
            'title' => 'Abendessen',
        ]);
        $option1 = $poll->options()->create(['label' => 'Pizza']);
        $option2 = $poll->options()->create(['label' => 'Burger']);

        $response = $this->post('/p/'.$poll->uuid.'/vote', [
            'name' => 'Max Mustermann',
            'votes' => [
                $option1->id => 'yes',
                $option2->id => 'maybe',
            ],
        ]);

        $this->assertDatabaseHas('participants', [
            'poll_id' => $poll->id,
            'name' => 'Max Mustermann',
        ]);

        $participant = Participant::first();
        $this->assertDatabaseHas('votes', [
            'participant_id' => $participant->id,
            'poll_option_id' => $option1->id,
            'response' => 'yes',
        ]);
        $this->assertDatabaseHas('votes', [
            'participant_id' => $participant->id,
            'poll_option_id' => $option2->id,
            'response' => 'maybe',
        ]);

        $response->assertRedirect();
    }

    public function test_participant_can_update_their_vote(): void
    {
        $user = User::factory()->create();
        $poll = $user->polls()->create([
            'uuid' => 'test-uuid-789',
            'title' => 'Sommerfest',
        ]);
        $option1 = $poll->options()->create(['label' => 'Juli']);
        $option2 = $poll->options()->create(['label' => 'August']);

        $participant = $poll->participants()->create([
            'name' => 'Anna',
            'edit_token' => 'token-anna-123',
        ]);

        $participant->votes()->create(['poll_option_id' => $option1->id, 'response' => 'yes']);
        $participant->votes()->create(['poll_option_id' => $option2->id, 'response' => 'no']);

        $response = $this->post("/p/{$poll->uuid}/vote/{$participant->edit_token}", [
            'name' => 'Anna M.',
            'votes' => [
                $option1->id => 'no',
                $option2->id => 'yes',
            ],
        ]);

        $this->assertDatabaseHas('participants', [
            'id' => $participant->id,
            'name' => 'Anna M.',
        ]);

        $this->assertDatabaseHas('votes', [
            'participant_id' => $participant->id,
            'poll_option_id' => $option1->id,
            'response' => 'no',
        ]);

        $this->assertDatabaseHas('votes', [
            'participant_id' => $participant->id,
            'poll_option_id' => $option2->id,
            'response' => 'yes',
        ]);

        $response->assertRedirect();
    }

    public function test_owner_can_delete_poll(): void
    {
        $user = User::factory()->create();
        $poll = $user->polls()->create([
            'uuid' => 'test-uuid-delete-123',
            'title' => 'Test Poll Delete',
        ]);

        $response = $this
            ->actingAs($user)
            ->delete("/polls/{$poll->uuid}");

        $this->assertDatabaseMissing('polls', [
            'id' => $poll->id,
        ]);

        $response->assertRedirect('/dashboard');
    }
}
