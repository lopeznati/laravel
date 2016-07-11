<?php

namespace App\Http\Controllers;

use App\Entities\Ticket;
use App\Repository\TicketRepository;
use App\Repository\VoteRepository;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $ticketRepository;
    /**
     * @var VoteRepository
     */
    private $voteRepository;

    public function  __construct(TicketRepository $ticketRepository, VoteRepository $voteRepository){
        $this->ticketRepository=$ticketRepository;


        $this->voteRepository = $voteRepository;
    }
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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

    public function submit($id,Guard $auth,Request $request)
    {
        //$ticket=Ticket::find($id);
        $ticket=$this->ticketRepository->find($id);

        $success=$this->voteRepository->vote($auth->user(),$ticket);
        //$auth->user()->vote($ticket);

        if($request->ajax()){
            return response()->json(compact('success'));

        }






        return redirect()->back();
    }
    public function destroy($id,Guard $auth,Request $request)
    {
        //
        //$ticket=Ticket::find($id);
        $ticket=$this->ticketRepository->find($id);
        $success=$this->voteRepository->unvote($auth->user(), $ticket);
        //$auth->user()->unvote($ticket);

        if($request->ajax()){
            return response()->json(compact('success'));

        }
        return redirect()->back();;
    }
}
