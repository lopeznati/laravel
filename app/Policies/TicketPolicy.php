<?php

namespace App\Policies;



use App\Entities\Ticket;
use App\Entities\User;

class TicketPolicy
{
    public function selectResource(User $user, Ticket $ticket)
    {
        return $user->id === $ticket->user_id &&$ticket->status=='open' ;
    }
    
}
