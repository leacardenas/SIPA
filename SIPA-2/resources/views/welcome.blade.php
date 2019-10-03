<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
    </head>
    <body>
        <form method="POST" action="{{ url('users') }}">
            @csrf 
            <div class="form-group row">
            <label for="username" class="col-md-4 col-form-label text-md-right">Cedula</label>

            <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    
            <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Constraseña') }}</label>

            <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <button type="submit" class="btn btn-primary">
                {{ __('Acceder') }}
            </button>
        </form>
    </body>
</html>
