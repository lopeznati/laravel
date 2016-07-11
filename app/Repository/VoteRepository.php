<?php
/**
 * Created by PhpStorm.
 * User: 09-MAPPLICS
 * Date: 11/7/2016
 * Time: 12:08 PM
 */

namespace App\Repository;


use App\Entities\Ticket;
use App\Entities\User;

class VoteRepository
{
    public function vote(User $user, Ticket $ticket){
        if($user->hasvote($ticket)) {
            return false;
        }

        $user->voted()->attach($ticket);
        return true;

    }

    public function unvote(User $user,Ticket $ticket){

        $user->voted()->detach($ticket);
        return true;

    }

}