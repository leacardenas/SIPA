<div>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js">
            
    </script>
    @include('sweet::alert')
    <form method="POST" action="{{url('/enviarCorreo')}}">
        @csrf
        <input type="text" name="correo" id="correo" required>

        <button type="submit">Enviar Correo</button>

    </form>
</div>