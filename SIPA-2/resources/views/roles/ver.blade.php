<div name = "divPrincipal">
    @php
        $roles = App\Rol::all();
    @endphp

    <div name = "divTitulo">
        <h1 name = "titulo">Roles Registrados</h1>
    </div>

    <table name = "tRoles">
        <thead>
            <tr>
                <th>Codigo</th> 
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Acción</th>      
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $rol)
                <tr>
                    <th>
                        {{$rol->sipa_roles_codigo}}
                    </th>
                    <th>
                        {{$rol->sipa_roles_nombre}}
                    </th>
                    <th>
                        {{$rol->sipa_roles_descripcion}}
                    </th>
                    <th>
                        <form method="get" action = "{{url('/verDetallerRol',$rol->sipa_roles_id)}}">
                            <button type = "submit">Ver detalle</button>
                        </form>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>