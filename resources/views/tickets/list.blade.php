
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

                <div data-id="25" class="well well-sm request">
                    <h4 class="list-title">
                       {{$ticket->titulo}}
                        <span class="label label-info absolute">{{trans('tickets.status.'.$ticket->status)}}</span>

                    </h4>
                    <p>
                        <a href="#" class="btn btn-primary btn-vote" title="Votar por este tutorial">
                            <span class="glyphicon glyphicon-thumbs-up"></span> Votar
                        </a>

                        <a href="#" class="btn btn-hight btn-unvote hide">
                            <span class="glyphicon glyphicon-thumbs-down"></span> No votar
                        </a>

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
@endsection('content')