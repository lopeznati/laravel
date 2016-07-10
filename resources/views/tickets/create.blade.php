@extends('layout')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Nueva solicitud</h2>

                <!-- erroressss -->
                @include('partials/errors')
                <!--encabezado y genera el token-->
                {!! Form::open(['route'=>'tickets.create','method'=>'POST'])!!}

                <div class="form-group">
                    {!! Form::label('titulo','Titulo:') !!}
                    {!! Form::textarea('titulo',null,['class'=>'form-control', 'rows'=>'4','cols'=>'50','placeholder'=>'Describe brevemente la solicitud']) !!}




                </div>





                <button type="submit" class="btn btn-primary">Enviar Solicitud</button>

                {!! Form::close() !!}


             </div>
        </div>
    </div>

@endsection('content')