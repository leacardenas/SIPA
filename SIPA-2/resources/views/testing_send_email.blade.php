{{-- Este html es solo para efectos de pruebas --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@if(count($errors)>0)
    <ul>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
    </ul>
@endif
@if($message = Session::get('success'))
    <strong> {{$message}}</strong>
@endif
<form method="GET" action="{{ url('/send') }}">
    @csrf
        <label>Content: </label>
        <textarea name="content" class="form"></textarea>
    <button type="submit" id="acceder">Acceder</button>
</form>