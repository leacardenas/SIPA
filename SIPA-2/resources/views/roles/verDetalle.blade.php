<div>
    @php
        $rol = App\Rol::where('sipa_roles_id',$id)->get();
       
    @endphp

<div name = "divTitulo">
    @foreach ($rol as $r)
    <div>    
        <h1 name = "titulo">Permisos del Rol {{$r->sipa_roles_nombre}}</h1>
    </div>

    @php
        $permisos = $r->permisos;
    @endphp

        <table name = "tMenus">
            <thead>
                <tr>
                    <th>
                        Nombre permiso
                    </th> 
                    <th>
                        Acceso
                    </th>    
                </tr>
            </thead>
            <tbody>
                @foreach ($permisos as $permiso)
                <tr>
                    <th>
                        {{$permiso->modulo->sipa_opciones_menu_nombre}}
                    </th>
                    <th>
                        {{$permiso->modulo->sipa_opciones_menu_descripcion }}
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>

    @endforeach
    
</div>