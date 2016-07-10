<?php

namespace App\Http\Controllers;

use App\Entities\Ticket;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        //
      //  $tickets=Ticket::all();

        $tickets=Ticket::orderBy('created_at','DESC')->paginate(30);
        return view('tickets.list',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popular()
    {
        //

        return view('tickets.list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function open()
    {
        //
        $tickets=Ticket::orderBy('created_at','DESC')->where('status','=','open')->paginate(30);
        return view('tickets.list',compact('tickets'));
    }
    public function closed()
    {
        //
        $tickets=Ticket::orderBy('created_at','DESC')->where('status','=','closed')->paginate(30);
        return view('tickets.list',compact('tickets'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        //
        $ticket=Ticket::find($id);
        return view('tickets.details',compact('ticket'));
    }


    public function create()
    {
        //
        return view('tickets.create');
    }

    /**
     * @param Request $request
     * @param Guard $auth
     * @return mixed
     */
    public function store(Request $request, Guard $auth)
    {
        //
        $this->validate($request,[
            'titulo'=>'required|max:120'
        ]);
        /*

        $ticket=new Ticket();
        $ticket->titulo=$request->get('titulo');
        $ticket->status='open';
        $ticket->user_id=$auth->user()->id;
        $ticket->save();
        */

        //cargo por la relacion hasmany

        $ticket=$auth->user()->tickets()->create([
            'titulo'=>$request->get('titulo'),
            'status'=>'open'
        ]);
        //dd($request->all());
        return Redirect::route('tickets.details',$ticket->id);

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
