<?php

namespace App\Http\Controllers;

use App\Entities\Ticket;
use App\Entities\TicketComment;
use App\Repository\CommentRepository;
use App\Repository\TicketRepository;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $commentRepository;
    private $TicketRepository;


    //asigno una instancia de CommentRepository

    public function  __construct(CommentRepository $commentRepository, TicketRepository $ticketRepository){


        $this->commentRepository=$commentRepository;
        $this->TicketRepository=$ticketRepository;


    }

    public function submit(Request $request)
    {
        //
        dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Guard $auth,$id)
    {
        //

        $this->validate($request,[
            'comment'=>'required|max:250',
            'link'=>'url'
        ]);

        $ticket=$this->TicketRepository->find($id);
        
        $this->commentRepository->create(
            $ticket,
            $auth->user(),
            $request->get('comment'),
            $request->get('link')
        );


        if($auth->check()) {


            $comment = new TicketComment($request->all());
            $comment->user_id = $auth->user()->id;
            //$auth->user()->comments()->save($comment);
            //$ticket = Ticket::find($id);
            $ticket->comments()->save($comment);

            // $comment->ticket_id=$ticket->id;

            //$comment->save();

            session()->flash('success', 'tu comentario fue guardado');
            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
