<?php
namespace App\Repository;
use App\Entities\Ticket;


/**
 * Created by PhpStorm.
 * User: 09-MAPPLICS
 * Date: 11/7/2016
 * Time: 10:47 AM
 */
class TicketRepository extends BaseRepository
{

    //la clase abstracta se convierte en concreta
    public function  getModel(){
        return new Ticket();
    }

    protected  function  selectTicketList(){
        return Ticket::selectRaw('TICKETS.*,'
            .'(SELECT COUNT(*) FROM ticket_comments  WHERE ticket_comments.ticket_id = tickets.id) as num_comments,'
            .'(SELECT COUNT(*) FROM ticket_votes  WHERE ticket_votes.ticket_id=tickets.id) as num_votes'

        )

            ->with('user');
    }

    public function paginateLatest(){
        return  $this->selectTicketList()
            ->orderBy('created_at','DESC')
            ->paginate(30);



    }

    public function paginateOpen(){
        return  $this->selectTicketList()
            ->orderBy('created_at','DESC')
            ->where('status','=','open')
            ->paginate(30);



    }
    public function paginateClosed(){
        return $this->selectTicketList()
            ->orderBy('created_at','DESC')
            ->where('status','=','closed')
            ->paginate(30);



    }
    
    public  function  openNewTicket($auth,$title){
        return $auth->tickets()->create([
            'titulo'=>$title,
            'status'=>'open'
        ]);
    }



}