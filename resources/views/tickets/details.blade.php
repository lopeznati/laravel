@extends('layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="title-show">
                {{$ticket->titulo}}

                @if($ticket->status=='open')
                    <span class="label label-info absolute highlight">{{trans('tickets.status.'.$ticket->status)}}</span>

                @else
                    <span class="label label-info absolute">{{trans('tickets.status.'.$ticket->status)}}</span>



                @endif

                @if($ticket->link)

                <a href="{{$ticket->link}}" target="_blank">Ver recurso</a>
                @endif


                @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>

                @endif

            </h2>
            <p class="date-t"><span class="glyphicon glyphicon-time"></span> {{$ticket->created_at->format('d/m/y h:ia')}}
            {{$ticket->user->name}}
            </p>
            <h4 class="label label-info news">
                {{count($ticket->voters)}}   votos            </h4>

            <p class="vote-users">
                @foreach($ticket->voters as $voter)
                <span class="label label-info">{{$voter->name}}</span>

                @endforeach
            </p>

            <!--pregunto si he votado -->
            @if (Auth::check())

            @if(!auth()->user()->hasVote($ticket))

            {!! Form::open(['route'=>['votes.submit',$ticket->id],'method'=>'POST']) !!}

            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-thumbs-up"></span> Votar
            </button>
            {!! Form::close() !!}

            @else

            {!! Form::open(['route'=>['votes.destroy',$ticket->id],'method'=>'DELETE']) !!}

            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-thumbs-down"></span> Eliminar voto
            </button>
            {!! Form::close() !!}

            @endif
            @endif

            <h3>Nuevo Comentario</h3>
            @include('partials/errors')

            {!! Form::open(['route'=>['comments.submit',$ticket->id],'method'=>'POST']) !!}
            <div class="form-group">
                {!! Form::label('comment','Comentarios:') !!}
                {!! Form::textarea('comment',null,['class'=>'form-control', 'rows'=>'4','cols'=>'50']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('link','Enlace:') !!}
                {!! Form::text('link',null,['class'=>'form-control']) !!}

            </div>
            <button type="submit" class="btn btn-primary">Enviar comentario</button>

            {!! Form::close() !!}

<!--
            <form method="POST" action="http://teachme.dev/comentar/5" accept-charset="UTF-8"><input name="_token" type="hidden" value="VBIv3EWDAIQuLRW0cGwNQ4OsDKoRhnK2fAEF6UbQ">
                <div class="form-group">
                    <label for="comment">Comentarios:</label>
                    <textarea rows="4" class="form-control" name="comment" cols="50" id="comment"></textarea>
                </div>
                <div class="form-group">
                    <label for="link">Enlace:</label>
                    <input class="form-control" name="link" type="text" id="link">
                </div>
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
            </form>
        -->

            <h3>Comentarios {{count($ticket->comments)}}</h3>

            @foreach($ticket->comments as $comment)

            <div class="well well-sm">
                <p><strong>{{$comment->user->name}}</strong></p>
                <p>{{$comment->comment}}</p>

                @if($comment->link)
                    <p>
                        <a href="{{$comment->link}}" rel="nofollow" target="_blank">{{$comment->link}}</a>
                    </p>

                    @can('selectResource', $ticket)
                        {!! Form::open(['route' => ['tickets.select', $ticket, $comment]]) !!}
                        <p>
                            <button type="submit" class="btn btn-primary">Seleccionar tutorial</button>
                        </p>
                        {!! Form::close() !!}
                    @endcan
                    @endif
                <p class="date-t"><span class="glyphicon glyphicon-time"></span>{{$comment->created_at->format('d/m/y h:ia')}}</p>
            </div>
            @endforeach
    </div>
</div>

@endsection('content')
