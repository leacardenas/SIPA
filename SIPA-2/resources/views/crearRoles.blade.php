<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
    </head>
    <body>
        <form method="POST" action="{{ url('roles/store') }}">
            @csrf_field
           
            <div class="form-group row">
                <label for="nombrerol" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Rol') }}</label>

            <div class="col-md-6">
                <input id="nombrerol" type="text" class=" " name="nombrerol" >
                    
            <div class="form-group row">
                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>
    
                <div class="col-md-6">
                    <input id="descripcion" type="text" class=" " name="descripcion" >
                
            <div class="form-group row">
                <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>
        
            <div class="col-md-6">
                <input id="codigo" type="text" class=" " name="codigo" >

            <button type="submit" class="btn btn-primary">
                {{ __('Crear') }}
            </button>
        </form>
    </body>
</html>