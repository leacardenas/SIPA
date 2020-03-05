
@extends('plantillas.error_case')
@section('content')

<form method="get" action="{{url('/')}}">
    <button type="submit" type="button" class="btn btn-secondary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Volver
    </button>
</form>

<h1>{{$mensaje_error}}</h1>

@endsection