
@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <h1>
                    {{$title=trans(Route::currentRouteName().'_title')}}
                    <a href="{{route('tickets.create')}}" class="btn btn-primary">
                        Nueva solicitud                    </a>
                </h1>

                <p class="label label-info news">
                    Hay {{$tickets->total()}} Solicitudes {{$title}}                </p>


                @foreach($tickets as $ticket)

                <div data-id="{{$ticket->id}}" class="well well-sm ticket">
                    <h4 class="list-title">
                       {{$ticket->titulo}}
                        <span class="label label-info absolute">{{trans('tickets.status.'.$ticket->status)}}</span>

                    </h4>
                    <p>
                        @if(Auth::check())

                        <a href="#" class="btn btn-primary btn-vote" title="Votar por este tutorial">
                            <span class="glyphicon glyphicon-thumbs-up"></span> Votar
                        </a>


                        <a href="#" class="btn btn-primary btn-unvote hidden">
                            <span class="glyphicon glyphicon-thumbs-down"></span> No votar
                        </a>

                        @endif

                        <a href="{{route('tickets.details',$ticket)}}">
                           <!-- <span class="votes-count">{{count($ticket->voters)}} votos</span>
                            <span class="comments-count">{{count($ticket->comments)}} comentarios</span>. -->


                           <span class="votes-count">{{$ticket->num_votes}} votos</span>
                             <span class="comments-count">{{$ticket->num_comments}} comentarios</span>.
                        </a>

                    <p class="date-t"><span class="glyphicon glyphicon-time"></span> {{$ticket->created_at->format('d/m/y h:ia')}}</p>

                    Por {{$ticket->user->name}}

                    </p>
                </div>
                    @endforeach



{!!$tickets->render()!!}
                 </div>

        </div>
    </div>
</div>

    {!!  Form::open(['id'=>'form-vote','route'=>['votes.submit',':id'],'method'=>'POST'])!!}

{!!Form::close()!!}


{!!Form::open(['id'=>'form-unvote','route'=>['votes.destroy',':id'],'method'=>'DELETE'])!!}

{!!Form::close()!!}
@endsection('content')