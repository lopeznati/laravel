<?php
/**
 * Created by PhpStorm.
 * User: 09-MAPPLICS
 * Date: 11/7/2016
 * Time: 11:44 AM
 */

namespace App\Repository;


use App\Entities\Ticket;
use App\Entities\TicketComment;
use App\Entities\User;
use Illuminate\Auth\Guard;


class CommentRepository extends BaseRepository
{
    public function  getModel(){
        return new TicketComment();
    }

    public function create(Ticket $ticket,User $auth,$comment,$link){
        $comment = new TicketComment(compact('comment','link'));
        $comment->user_id = $auth->id;
        //$auth->user()->comments()->save($comment);
        //$ticket = Ticket::find($id);
        $ticket->comments()->save($comment);


    }

}