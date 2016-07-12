<?php

use App\Policies\TicketPolicy;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Gate;

class TicketPolicyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;
    public function test_autor_can_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $policy = new TicketPolicy();

        $this->assertTrue($policy->selectResource($user, $ticket));

    }

    public function test_other_users_cannot_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $otherUser = seed('User');

        $policy = new TicketPolicy();

        $this->assertFalse($policy->selectResource($otherUser, $ticket));
    }

    public function test_prevent_users_for_selecting_a_resource_twice()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id,
            'status'  => 'closed',
        ]);

        $policy = new TicketPolicy();

        $this->assertFalse($policy->selectResource($user, $ticket));
    }

    public function test_administrators_can_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $admin = seed('User', [
            'role' => 'admin'
        ]);

        $this->assertTrue($admin->can('selectResource', $ticket));
       // $this->assertTrue(Gate::forUser($admin)->allows('selectResource', $ticket));
    }

    public function test_administrator_select_two_resources()
    {
        // Having
        $user = seed('User', ['role' => 'admin']);
        $ticket = seed('Ticket', ['user_id' => $user->id]);

        $comment1 = seed('TicketComments', [
            'ticket_id' => $ticket->id,
            'link'      => 'https://styde.net'
        ]);

        $comment2 = seed('TicketComments', [
            'ticket_id' => $ticket->id,
            'link'      => 'https://twitter.com/StydeNet'
        ]);

        // When
        $ticket->assignResource($comment1);
        $ticket->assignResource($comment2);

        // Then
        $this->seeInDatabase('tickets', [
            'id'   => $ticket->id,
            'link' => 'https://twitter.com/StydeNet'
        ]);

        $this->seeInDatabase('ticket_comments', [
            'id'       => $comment1->id,
            'selected' => false,
        ]);

        $this->seeInDatabase('ticket_comments', [
            'id'       => $comment2->id,
            'selected' => true,
        ]);
    }


}
