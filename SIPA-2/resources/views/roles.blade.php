<h1>roles</h1>
<table>
    <tbody>
        <tr>
        <td><a>id</a></td>
        <td><a>codigo</a></td>
        <td><a>nombre</a></td>
        <td><a>descripcion</a></td>
        <td><a>creado por</a></td>
        <td><a>actualizado por</a></td>
        <td><a>fecha creacion</a></td>
        <td><a>fecha ultima actualizacion</a></td>
        </tr>
        @if(count($roles) > 0)
            @foreach($roles as $role)
                <tr>
                    <td><a>{{$role->sipa_roles_id}}</a></td>
                    <td><a>{{$role->sipa_roles_codigo}}</a></td>
                    <td><a>{{$role->sipa_roles_nombre}}</a></td>
                    <td><a>{{$role->sipa_roles_descripcion}}</a></td>
                    <td><a>{{$role->sipa_roles_usuario_creador}}</a></td>
                    <td><a>{{$role->sipa_roles_usuario_actualizacion}}</a></td>
                    <td><a>{{$role->created_at}}</a></td>
                    <td><a>{{$role->updated_at}}</a></td>
                </tr>
            @endforeach
        @else
            <p>No posts found</p>
        @endif
</tbody>
</table>