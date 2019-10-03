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
            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Usuario/Cédula') }}</label>

            <div class="col-md-6">
            <input id="username" type="text" class=" " name="username" value="{{ $user->sipa_usuarios_identificacion }}">
                    
            <div class="form-group row">
            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

            <div class="col-md-6">
            <input id="nombre" type="text" class=" " name="nombre" value="{{ $user->name }}">

            <div class="form-group row">
            <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>
        
            <div class="col-md-6">
            <input id="apellidos" type="text" class=" " name="apellidos" value="{{ $user->sipa_usuarios_apellidos }}">

            <div class="form-group row">
            <label for="correo" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electronico') }}</label>
                
            <div class="col-md-6">
            <input id="correo" type="text" class=" " name="correo" value="{{ $user->email }}">

            <div class="form-group row">
            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('telefono') }}</label>
                        
            <div class="col-md-6">
            <input id="telefono" type="text" class=" " name="correo">
            
                    <button type="submit" class="btn btn-primary">
                {{ __('Acceder') }}
            </button>
        </form>
    </body>
</html>