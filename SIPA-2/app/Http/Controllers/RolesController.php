<?php

namespace App\Http\Controllers;

  use Illuminate\Http\Request;
  use App\Rol;
  use App\Permiso;
  use App\User;
  use App\Modulo;

  class RolesController extends Controller
  {
      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
          $this->validate($request, [
              'codigo' => 'required',
              'nombreRol' => 'required',
              'descRol' => 'required'
          ]);

          $username = session('idUsuario');
          $codigo = $request->input('codigo');
          $nombre = $request->input('nombreRol');
          $descripcion = $request->input('descRol');
          $usuario = User::where('sipa_usuarios_identificacion',$username)->get()[0];

          $rol = new Rol;
          $rol->sipa_roles_codigo = $codigo;
          $rol->sipa_roles_nombre = $nombre;
          $rol->sipa_roles_descripcion = $descripcion;
          $rol->sipa_roles_usuario_creador = $usuario->sipa_usuarios_id;
          $rol->save();

          $this->creaPermisos($request, $rol, $usuario);

          return view('menus.editarRoles');
      }

      public function borrarRol(Request $request, $id){
        try{
            $rol = Rol::find($id);
            $this->borrarPermisos($rol);
            $rol->delete();
            alert('Se eliminó el rol')->persistent("Close this");
            #return redirect()->route('inventarioEquipos');
            return view('menus.editarRoles');
        }
        catch (Exception $e) {
            alert('Error eliminando el rol')->persistent("Close this");
        }
    }

      public function editarRolSeleccionado(Request $request, $id)
      {
        $username = session('idUsuario');
        $upd_codigo = $request->input('codigo');
        $upd_nombre = $request->input('nombreRol');
        $upd_descripcion = $request->input('descRol');
        $upd_usuario = User::where('sipa_usuarios_identificacion',$username)->get()[0];

        $upd_rol = Rol::find($id);
        $upd_rol->update(['sipa_roles_nombre'=>$upd_nombre,
                            'sipa_roles_codigo'=>$upd_codigo,
                            'sipa_roles_descripcion'=>$upd_descripcion,
                            'sipa_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $this->editarPermisos($request, $upd_rol, $upd_usuario);
                            
        return view('menus.editarRoles');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
          //
      }

      public function isOnOff($input){
          if($input == 'on')
              return true;
          else
              return false;
      }

      public function creaPermisos(Request $request, Rol $rol, User $usuario){
          //Variables de ambiente de los permisos
          $crear_ReservaSalas = $this->isOnOff($request->input('crear_reserva_salas'));
          $editar_ReservaSalas = $this->isOnOff($request->input('editar_reserva_salas'));
          $ver_ReservaSalas = $this->isOnOff($request->input('ver_reserva_salas'));
          $borrar_ReservaSalas = $this->isOnOff($request->input('borrar_reserva_salas'));
          $exportar_ReservaSalas = $this->isOnOff($request->input('exportar_reserva_salas'));
          $menu_ReservaSalas = Modulo::where('sipa_opciones_menu_codigo','RESERVAR_SALA')->get()[0];

          $crear_ReservaEquipos = $this->isOnOff($request->input('crear_reserva_equipos'));
          $editar_ReservaEquipos = $this->isOnOff($request->input('editar_reserva_equipos'));
          $ver_ReservaEquipos = $this->isOnOff($request->input('ver_reserva_equipos'));
          $borrar_ReservaEquipos = $this->isOnOff($request->input('borrar_reserva_equipos'));
          $exportar_ReservaEquipos = $this->isOnOff($request->input('exportar_reserva_equipos'));
          $menu_ReservaEquipos = Modulo::where('sipa_opciones_menu_codigo','RESERVAR_EQUIPO')->get()[0];

          $crear_InventarioEnUsoSalas = $this->isOnOff($request->input('crear_inventario_en_uso_salas'));
          $editar_InventarioEnUsoSalas = $this->isOnOff($request->input('editar_inventario_en_uso_salas'));
          $ver_InventarioEnUsoSalas = $this->isOnOff($request->input('ver_inventario_en_uso_salas'));
          $borrar_InventarioEnUsoSalas = $this->isOnOff($request->input('borrar_inventario_en_uso_salas'));
          $exportar_InventarioEnUsoSalas = $this->isOnOff($request->input('exportar_inventario_en_uso_salas'));
          $menu_InventarioEnUsoSalas = Modulo::where('sipa_opciones_menu_codigo','INV_USO_SALA')->get()[0];

          $crear_InventarioEnUsoEquipos = $this->isOnOff($request->input('crear_inventario_en_uso_equipos'));
          $editar_InventarioEnUsoEquipos = $this->isOnOff($request->input('editar_inventario_en_uso_equipos'));
          $ver_InventarioEnUsoEquipos = $this->isOnOff($request->input('ver_inventario_en_uso_equipos'));
          $borrar_InventarioEnUsoEquipos = $this->isOnOff($request->input('borrar_inventario_en_uso_equipos'));
          $exportar_InventarioEnUsoEquipos = $this->isOnOff($request->input('exportar_inventario_en_uso_equipos'));
          $menu_InventarioEnUsoEquipos = Modulo::where('sipa_opciones_menu_codigo','INV_USO_EQUIPO')->get()[0];

          $crear_EntregaSalas = $this->isOnOff($request->input('crear_entrega_salas'));
          $editar_EntregaSalas = $this->isOnOff($request->input('editar_entrega_salas'));
          $ver_EntregaSalas = $this->isOnOff($request->input('ver_entrega_salas'));
          $borrar_EntregaSalas = $this->isOnOff($request->input('borrar_entrega_salas'));
          $exportar_EntregaSalas = $this->isOnOff($request->input('exportar_entrega_salas'));
          $menu_EntregaSalas = Modulo::where('sipa_opciones_menu_codigo','ENTREG_SALA')->get()[0];

          $crear_EntregaEquipos = $this->isOnOff($request->input('crear_entrega_equipos'));
          $editar_EntregaEquipos = $this->isOnOff($request->input('editar_entrega_equipos'));
          $ver_EntregaEquipos = $this->isOnOff($request->input('ver_entrega_equipos'));
          $borrar_EntregaEquipos = $this->isOnOff($request->input('borrar_entrega_equipos'));
          $exportar_EntregaEquipos = $this->isOnOff($request->input('exportar_entrega_equipos'));
          $menu_EntregaEquipos = Modulo::where('sipa_opciones_menu_codigo','ENTREG_EQUIPO')->get()[0];

          $crear_DevolucionSalas = $this->isOnOff($request->input('crear_devolucion_salas'));
          $editar_DevolucionSalas = $this->isOnOff($request->input('editar_devolucion_salas'));
          $ver_DevolucionSalas = $this->isOnOff($request->input('ver_devolucion_salas'));
          $borrar_DevolucionSalas = $this->isOnOff($request->input('borrar_devolucion_salas'));
          $exportar_DevolucionSalas = $this->isOnOff($request->input('exportar_devolucion_salas'));
          $menu_DevolucionSalas = Modulo::where('sipa_opciones_menu_codigo','DEVOLU_SALA')->get()[0];

          $crear_DevolucionEquipos = $this->isOnOff($request->input('crear_devolucion_equipos'));
          $editar_DevolucionEquipos = $this->isOnOff($request->input('editar_devolucion_equipos'));
          $ver_DevolucionEquipos = $this->isOnOff($request->input('ver_devolucion_equipos'));
          $borrar_DevolucionEquipos = $this->isOnOff($request->input('borrar_devolucion_equipos'));
          $exportar_DevolucionEquipos = $this->isOnOff($request->input('exportar_devolucion_equipos'));
          $menu_DevolucionEquipos = Modulo::where('sipa_opciones_menu_codigo','DEVOLU_EQUIPO')->get()[0];

          $crear_InventarioSalas = $this->isOnOff($request->input('crear_inventario_salas'));
          $editar_InventarioSalas = $this->isOnOff($request->input('editar_inventario_salas'));
          $ver_InventarioSalas = $this->isOnOff($request->input('ver_inventario_salas'));
          $borrar_InventarioSalas = $this->isOnOff($request->input('borrar_inventario_salas'));
          $exportar_InventarioSalas = $this->isOnOff($request->input('exportar_inventario_salas'));
          $menu_InventarioSalas = Modulo::where('sipa_opciones_menu_codigo','INV_SALA')->get()[0];

          $crear_InventarioEquipos = $this->isOnOff($request->input('crear_inventario_equipos'));
          $editar_InventarioEquipos = $this->isOnOff($request->input('editar_inventario_equipos'));
          $ver_InventarioEquipos = $this->isOnOff($request->input('ver_inventario_equipos'));
          $borrar_InventarioEquipos = $this->isOnOff($request->input('borrar_inventario_equipos'));
          $exportar_InventarioEquipos = $this->isOnOff($request->input('exportar_inventario_equipos'));
          $menu_InventarioEquipos = Modulo::where('sipa_opciones_menu_codigo','INV_EQUIPO')->get()[0];

          $crear_InventarioInsumos = $this->isOnOff($request->input('crear_inventario_insumos'));
          $editar_InventarioInsumos = $this->isOnOff($request->input('editar_inventario_insumos'));
          $ver_InventarioInsumos = $this->isOnOff($request->input('ver_inventario_insumos'));
          $borrar_InventarioInsumos = $this->isOnOff($request->input('borrar_inventario_insumos'));
          $exportar_InventarioInsumos = $this->isOnOff($request->input('exportar_inventario_insumos'));
          $menu_InventarioInsumos = Modulo::where('sipa_opciones_menu_codigo','INV_INSUMO')->get()[0];

          $crear_Formularios = $this->isOnOff($request->input('crear_formularios'));
          $editar_Formularios = $this->isOnOff($request->input('editar_formularios'));
          $ver_Formularios = $this->isOnOff($request->input('ver_formularios'));
          $borrar_Formularios = $this->isOnOff($request->input('borrar_formularios'));
          $exportar_Formularios = $this->isOnOff($request->input('exportar_formularios'));
          $menu_Formularios = Modulo::where('sipa_opciones_menu_codigo','INV_FORMULARIOS')->get()[0];

          $crear_HistorialSalasAnticipadas = $this->isOnOff($request->input('crear_historial_salas_anticipadas'));
          $editar_HistorialSalasAnticipadas = $this->isOnOff($request->input('editar_historial_salas_anticipadas'));
          $ver_HistorialSalasAnticipadas = $this->isOnOff($request->input('ver_historial_salas_anticipadas'));
          $borrar_HistorialSalasAnticipadas = $this->isOnOff($request->input('borrar_historial_salas_anticipadas'));
          $exportar_HistorialSalasAnticipadas = $this->isOnOff($request->input('exportar_historial_salas_anticipadas'));
          $menu_HistorialSalasAnticipadas = Modulo::where('sipa_opciones_menu_codigo','HISTO_SALA_ANTICIPADA')->get()[0];

          $crear_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('crear_historial_salas_reservadas_en_momento'));
          $editar_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('editar_historial_salas_reservadas_en_momento'));
          $ver_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('ver_historial_salas_reservadas_en_momento'));
          $borrar_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('borrar_historial_salas_reservadas_en_momento'));
          $exportar_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('exportar_historial_salas_reservadas_en_momento'));
          $menu_HistorialSalasReservadasEnMomento = Modulo::where('sipa_opciones_menu_codigo','HISTO_SALA_RAPIDAS')->get()[0];

          $crear_HistorialEquiposAnticipados = $this->isOnOff($request->input('crear_historial_equipos_anticipados'));
          $editar_HistorialEquiposAnticipados = $this->isOnOff($request->input('editar_historial_equipos_anticipados'));
          $ver_HistorialEquiposAnticipados = $this->isOnOff($request->input('ver_historial_equipos_anticipados'));
          $borrar_HistorialEquiposAnticipados = $this->isOnOff($request->input('borrar_historial_equipos_anticipados'));
          $exportar_HistorialEquiposAnticipados = $this->isOnOff($request->input('exportar_historial_equipos_anticipados'));
          $menu_HistorialEquiposAnticipados = Modulo::where('sipa_opciones_menu_codigo','HISTO_SALA_ANTICIPADA')->get()[0];

          $crear_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('crear_historial_equipos_reservados_en_momento'));
          $editar_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('editar_historial_equipos_reservados_en_momento'));
          $ver_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('ver_historial_equipos_reservados_en_momento'));
          $borrar_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('borrar_historial_equipos_reservados_en_momento'));
          $exportar_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('exportar_historial_equipos_reservados_en_momento'));
          $menu_HistorialEquiposReservadosEnMomento = Modulo::where('sipa_opciones_menu_codigo','HISTO_SALA_RAPIDAS')->get()[0];

          $crear_ConfiguracionCorreos = $this->isOnOff('off');
          $editar_ConfiguracionCorreos = $this->isOnOff('off');
          $ver_ConfiguracionCorreos = $this->isOnOff($request->input('ver_configuracion_correos'));
          $borrar_ConfiguracionCorreos = $this->isOnOff('off');
          $exportar_ConfiguracionCorreos = $this->isOnOff($request->input('exportar_configuracion_correos'));
          $menu_ConfiguracionCorreos = Modulo::where('sipa_opciones_menu_codigo','CONFIG_CORREOS')->get()[0];

          $crear_ConfiguracionUsuarios = $this->isOnOff('off');
          $editar_ConfiguracionUsuarios = $this->isOnOff('off');
          $ver_ConfiguracionUsuarios = $this->isOnOff($request->input('ver_configuracion_usuarios'));
          $borrar_ConfiguracionUsuarios = $this->isOnOff('off');
          $exportar_ConfiguracionUsuarios = $this->isOnOff($request->input('exportar_configuracion_usuarios'));
          $menu_ConfiguracionUsuarios = Modulo::where('sipa_opciones_menu_codigo','CONFIG_TIPO_USUARIOS')->get()[0];

          $crear_ConfiguracionTiposDeUsuario = $this->isOnOff('off');
          $editar_ConfiguracionTiposDeUsuario = $this->isOnOff('off');
          $ver_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('ver_configuracion_tipos_de_usuario'));
          $borrar_ConfiguracionTiposDeUsuario = $this->isOnOff('off');
          $exportar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('exportar_configuracion_tipos_de_usuario'));
          $menu_ConfiguracionTiposDeUsuario = Modulo::where('sipa_opciones_menu_codigo','CONFIG_USUARIOS')->get()[0];

          $crear_ConfiguracionRoles = $this->isOnOff('off');
          $editar_ConfiguracionRoles = $this->isOnOff('off');
          $ver_ConfiguracionRoles = $this->isOnOff($request->input('ver_configuracion_roles'));
          $borrar_ConfiguracionRoles = $this->isOnOff('off');
          $exportar_ConfiguracionRoles = $this->isOnOff($request->input('exportar_configuracion_roles'));
          $menu_ConfiguracionRoles = Modulo::where('sipa_opciones_menu_codigo','CONFIG_ROLES')->get()[0];

          //Creacion de los permisos
          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_ReservaSalas->sipa_opciones_menu_id ;
          $permiso->sipa_permisos_roles_crear = $crear_ReservaSalas;
          $permiso->sipa_permisos_roles_editar = $editar_ReservaSalas;
          $permiso->sipa_permisos_roles_ver = $ver_ReservaSalas;
          $permiso->sipa_permisos_roles_borrar = $borrar_ReservaSalas;
          $permiso->sipa_permisos_roles_exportar = $exportar_ReservaSalas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_ReservaSalas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_ReservaEquipos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_ReservaEquipos;
          $permiso->sipa_permisos_roles_editar = $editar_ReservaEquipos;
          $permiso->sipa_permisos_roles_ver = $ver_ReservaEquipos;
          $permiso->sipa_permisos_roles_borrar = $borrar_ReservaEquipos;
          $permiso->sipa_permisos_roles_exportar = $exportar_ReservaEquipos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_ReservaEquipos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_InventarioEnUsoSalas->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_InventarioEnUsoSalas;
          $permiso->sipa_permisos_roles_editar = $editar_InventarioEnUsoSalas;
          $permiso->sipa_permisos_roles_ver = $ver_InventarioEnUsoSalas;
          $permiso->sipa_permisos_roles_borrar = $borrar_InventarioEnUsoSalas;
          $permiso->sipa_permisos_roles_exportar = $exportar_InventarioEnUsoSalas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_InventarioEnUsoSalas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_InventarioEnUsoEquipos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_InventarioEnUsoEquipos;
          $permiso->sipa_permisos_roles_editar = $editar_InventarioEnUsoEquipos;
          $permiso->sipa_permisos_roles_ver = $ver_InventarioEnUsoEquipos;
          $permiso->sipa_permisos_roles_borrar = $borrar_InventarioEnUsoEquipos;
          $permiso->sipa_permisos_roles_exportar = $exportar_InventarioEnUsoEquipos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_InventarioEnUsoEquipos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_EntregaSalas->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_EntregaSalas;
          $permiso->sipa_permisos_roles_editar = $editar_EntregaSalas;
          $permiso->sipa_permisos_roles_ver = $ver_EntregaSalas;
          $permiso->sipa_permisos_roles_borrar = $borrar_EntregaSalas;
          $permiso->sipa_permisos_roles_exportar = $exportar_EntregaSalas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_EntregaSalas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_EntregaEquipos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_EntregaEquipos;
          $permiso->sipa_permisos_roles_editar = $editar_EntregaEquipos;
          $permiso->sipa_permisos_roles_ver = $ver_EntregaEquipos;
          $permiso->sipa_permisos_roles_borrar = $borrar_EntregaEquipos;
          $permiso->sipa_permisos_roles_exportar = $exportar_EntregaEquipos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_EntregaEquipos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_DevolucionSalas->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_DevolucionSalas;
          $permiso->sipa_permisos_roles_editar = $editar_DevolucionSalas;
          $permiso->sipa_permisos_roles_ver = $ver_DevolucionSalas;
          $permiso->sipa_permisos_roles_borrar = $borrar_DevolucionSalas;
          $permiso->sipa_permisos_roles_exportar = $exportar_DevolucionSalas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_DevolucionSalas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_DevolucionEquipos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_DevolucionEquipos;
          $permiso->sipa_permisos_roles_editar = $editar_DevolucionEquipos;
          $permiso->sipa_permisos_roles_ver = $ver_DevolucionEquipos;
          $permiso->sipa_permisos_roles_borrar = $borrar_DevolucionEquipos;
          $permiso->sipa_permisos_roles_exportar = $exportar_DevolucionEquipos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_DevolucionEquipos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_InventarioSalas->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_InventarioSalas;
          $permiso->sipa_permisos_roles_editar = $editar_InventarioSalas;
          $permiso->sipa_permisos_roles_ver = $ver_InventarioSalas;
          $permiso->sipa_permisos_roles_borrar = $borrar_InventarioSalas;
          $permiso->sipa_permisos_roles_exportar = $exportar_InventarioSalas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_InventarioSalas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_InventarioEquipos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_InventarioEquipos;
          $permiso->sipa_permisos_roles_editar = $editar_InventarioEquipos;
          $permiso->sipa_permisos_roles_ver = $ver_InventarioEquipos;
          $permiso->sipa_permisos_roles_borrar = $borrar_InventarioEquipos;
          $permiso->sipa_permisos_roles_exportar = $exportar_InventarioEquipos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_InventarioEquipos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_InventarioInsumos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_InventarioInsumos;
          $permiso->sipa_permisos_roles_editar = $editar_InventarioInsumos;
          $permiso->sipa_permisos_roles_ver = $ver_InventarioInsumos;
          $permiso->sipa_permisos_roles_borrar = $borrar_InventarioInsumos;
          $permiso->sipa_permisos_roles_exportar = $exportar_InventarioInsumos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_InventarioInsumos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Formularios->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_Formularios;
          $permiso->sipa_permisos_roles_editar = $editar_Formularios;
          $permiso->sipa_permisos_roles_ver = $ver_Formularios;
          $permiso->sipa_permisos_roles_borrar = $borrar_Formularios;
          $permiso->sipa_permisos_roles_exportar = $exportar_Formularios;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Formularios->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_HistorialSalasAnticipadas->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_HistorialSalasAnticipadas;
          $permiso->sipa_permisos_roles_editar = $editar_HistorialSalasAnticipadas;
          $permiso->sipa_permisos_roles_ver = $ver_HistorialSalasAnticipadas;
          $permiso->sipa_permisos_roles_borrar = $borrar_HistorialSalasAnticipadas;
          $permiso->sipa_permisos_roles_exportar = $exportar_HistorialSalasAnticipadas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_HistorialSalasAnticipadas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_HistorialSalasReservadasEnMomento->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_HistorialSalasReservadasEnMomento;
          $permiso->sipa_permisos_roles_editar = $editar_HistorialSalasReservadasEnMomento;
          $permiso->sipa_permisos_roles_ver = $ver_HistorialSalasReservadasEnMomento;
          $permiso->sipa_permisos_roles_borrar = $borrar_HistorialSalasReservadasEnMomento;
          $permiso->sipa_permisos_roles_exportar = $exportar_HistorialSalasReservadasEnMomento;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_HistorialSalasReservadasEnMomento->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_HistorialEquiposAnticipados->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_HistorialEquiposAnticipados;
          $permiso->sipa_permisos_roles_editar = $editar_HistorialEquiposAnticipados;
          $permiso->sipa_permisos_roles_ver = $ver_HistorialEquiposAnticipados;
          $permiso->sipa_permisos_roles_borrar = $borrar_HistorialEquiposAnticipados;
          $permiso->sipa_permisos_roles_exportar = $exportar_HistorialEquiposAnticipados;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_HistorialEquiposAnticipados->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_HistorialEquiposReservadosEnMomento->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_HistorialEquiposReservadosEnMomento;
          $permiso->sipa_permisos_roles_editar = $editar_HistorialEquiposReservadosEnMomento;
          $permiso->sipa_permisos_roles_ver = $ver_HistorialEquiposReservadosEnMomento;
          $permiso->sipa_permisos_roles_borrar = $borrar_HistorialEquiposReservadosEnMomento;
          $permiso->sipa_permisos_roles_exportar = $exportar_HistorialEquiposReservadosEnMomento;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_HistorialEquiposReservadosEnMomento->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_ConfiguracionCorreos->sipa_opciones_menu_id ;
          $permiso->sipa_permisos_roles_crear = $crear_ConfiguracionCorreos;
          $permiso->sipa_permisos_roles_editar = $editar_ConfiguracionCorreos;
          $permiso->sipa_permisos_roles_ver = $ver_ConfiguracionCorreos;
          $permiso->sipa_permisos_roles_borrar = $borrar_ConfiguracionCorreos;
          $permiso->sipa_permisos_roles_exportar = $exportar_ConfiguracionCorreos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_ConfiguracionCorreos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_ConfiguracionUsuarios->sipa_opciones_menu_id ;
          $permiso->sipa_permisos_roles_crear = $crear_ConfiguracionUsuarios;
          $permiso->sipa_permisos_roles_editar = $editar_ConfiguracionUsuarios;
          $permiso->sipa_permisos_roles_ver = $ver_ConfiguracionUsuarios;
          $permiso->sipa_permisos_roles_borrar = $borrar_ConfiguracionUsuarios;
          $permiso->sipa_permisos_roles_exportar = $exportar_ConfiguracionUsuarios;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_ConfiguracionUsuarios->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_ConfiguracionTiposDeUsuario->sipa_opciones_menu_id ;
          $permiso->sipa_permisos_roles_crear = $crear_ConfiguracionTiposDeUsuario;
          $permiso->sipa_permisos_roles_editar = $editar_ConfiguracionTiposDeUsuario;
          $permiso->sipa_permisos_roles_ver = $ver_ConfiguracionTiposDeUsuario;
          $permiso->sipa_permisos_roles_borrar = $borrar_ConfiguracionTiposDeUsuario;
          $permiso->sipa_permisos_roles_exportar = $exportar_ConfiguracionTiposDeUsuario;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_ConfiguracionTiposDeUsuario->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_ConfiguracionRoles->sipa_opciones_menu_id ;
          $permiso->sipa_permisos_roles_crear = $crear_ConfiguracionRoles;
          $permiso->sipa_permisos_roles_editar = $editar_ConfiguracionRoles;
          $permiso->sipa_permisos_roles_ver = $ver_ConfiguracionRoles;
          $permiso->sipa_permisos_roles_borrar = $borrar_ConfiguracionRoles;
          $permiso->sipa_permisos_roles_exportar = $exportar_ConfiguracionRoles;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_ConfiguracionRoles->sipa_opciones_menu_codigo;
          $permiso->save();
      }

      public function editarPermisos(Request $request, Rol $upd_rol, User $upd_usuario){
        //Variables de ambiente de los permisos
        $upd_crear_ReservaSalas = $this->isOnOff($request->input('crear_reserva_salas'));
        $upd_editar_ReservaSalas = $this->isOnOff($request->input('editar_reserva_salas'));
        $upd_ver_ReservaSalas = $this->isOnOff($request->input('ver_reserva_salas'));
        $upd_borrar_ReservaSalas = $this->isOnOff($request->input('borrar_reserva_salas'));
        $upd_exportar_ReservaSalas = $this->isOnOff($request->input('exportar_reserva_salas'));

        $upd_crear_ReservaEquipos = $this->isOnOff($request->input('crear_reserva_equipos'));
        $upd_editar_ReservaEquipos = $this->isOnOff($request->input('editar_reserva_equipos'));
        $upd_ver_ReservaEquipos = $this->isOnOff($request->input('ver_reserva_equipos'));
        $upd_borrar_ReservaEquipos = $this->isOnOff($request->input('borrar_reserva_equipos'));
        $upd_exportar_ReservaEquipos = $this->isOnOff($request->input('exportar_reserva_equipos'));

        $upd_crear_InventarioEnUsoSalas = $this->isOnOff($request->input('crear_inventario_en_uso_salas'));
        $upd_editar_InventarioEnUsoSalas = $this->isOnOff($request->input('editar_inventario_en_uso_salas'));
        $upd_ver_InventarioEnUsoSalas = $this->isOnOff($request->input('ver_inventario_en_uso_salas'));
        $upd_borrar_InventarioEnUsoSalas = $this->isOnOff($request->input('borrar_inventario_en_uso_salas'));
        $upd_exportar_InventarioEnUsoSalas = $this->isOnOff($request->input('exportar_inventario_en_uso_salas'));

        $upd_crear_InventarioEnUsoEquipos = $this->isOnOff($request->input('crear_inventario_en_uso_equipos'));
        $upd_editar_InventarioEnUsoEquipos = $this->isOnOff($request->input('editar_inventario_en_uso_equipos'));
        $upd_ver_InventarioEnUsoEquipos = $this->isOnOff($request->input('ver_inventario_en_uso_equipos'));
        $upd_borrar_InventarioEnUsoEquipos = $this->isOnOff($request->input('borrar_inventario_en_uso_equipos'));
        $upd_exportar_InventarioEnUsoEquipos = $this->isOnOff($request->input('exportar_inventario_en_uso_equipos'));

        $upd_crear_EntregaSalas = $this->isOnOff($request->input('crear_entrega_salas'));
        $upd_editar_EntregaSalas = $this->isOnOff($request->input('editar_entrega_salas'));
        $upd_ver_EntregaSalas = $this->isOnOff($request->input('ver_entrega_salas'));
        $upd_borrar_EntregaSalas = $this->isOnOff($request->input('borrar_entrega_salas'));
        $upd_exportar_EntregaSalas = $this->isOnOff($request->input('exportar_entrega_salas'));

        $upd_crear_EntregaEquipos = $this->isOnOff($request->input('crear_entrega_equipos'));
        $upd_editar_EntregaEquipos = $this->isOnOff($request->input('editar_entrega_equipos'));
        $upd_ver_EntregaEquipos = $this->isOnOff($request->input('ver_entrega_equipos'));
        $upd_borrar_EntregaEquipos = $this->isOnOff($request->input('borrar_entrega_equipos'));
        $upd_exportar_EntregaEquipos = $this->isOnOff($request->input('exportar_entrega_equipos'));

        $upd_crear_DevolucionSalas = $this->isOnOff($request->input('crear_devolucion_salas'));
        $upd_editar_DevolucionSalas = $this->isOnOff($request->input('editar_devolucion_salas'));
        $upd_ver_DevolucionSalas = $this->isOnOff($request->input('ver_devolucion_salas'));
        $upd_borrar_DevolucionSalas = $this->isOnOff($request->input('borrar_devolucion_salas'));
        $upd_exportar_DevolucionSalas = $this->isOnOff($request->input('exportar_devolucion_salas'));

        $upd_crear_DevolucionEquipos = $this->isOnOff($request->input('crear_devolucion_equipos'));
        $upd_editar_DevolucionEquipos = $this->isOnOff($request->input('editar_devolucion_equipos'));
        $upd_ver_DevolucionEquipos = $this->isOnOff($request->input('ver_devolucion_equipos'));
        $upd_borrar_DevolucionEquipos = $this->isOnOff($request->input('borrar_devolucion_equipos'));
        $upd_exportar_DevolucionEquipos = $this->isOnOff($request->input('exportar_devolucion_equipos'));

        $upd_crear_InventarioSalas = $this->isOnOff($request->input('crear_inventario_salas'));
        $upd_editar_InventarioSalas = $this->isOnOff($request->input('editar_inventario_salas'));
        $upd_ver_InventarioSalas = $this->isOnOff($request->input('ver_inventario_salas'));
        $upd_borrar_InventarioSalas = $this->isOnOff($request->input('borrar_inventario_salas'));
        $upd_exportar_InventarioSalas = $this->isOnOff($request->input('exportar_inventario_salas'));

        $upd_crear_InventarioEquipos = $this->isOnOff($request->input('crear_inventario_equipos'));
        $upd_editar_InventarioEquipos = $this->isOnOff($request->input('editar_inventario_equipos'));
        $upd_ver_InventarioEquipos = $this->isOnOff($request->input('ver_inventario_equipos'));
        $upd_borrar_InventarioEquipos = $this->isOnOff($request->input('borrar_inventario_equipos'));
        $upd_exportar_InventarioEquipos = $this->isOnOff($request->input('exportar_inventario_equipos'));

        $upd_crear_InventarioInsumos = $this->isOnOff($request->input('crear_inventario_insumos'));
        $upd_editar_InventarioInsumos = $this->isOnOff($request->input('editar_inventario_insumos'));
        $upd_ver_InventarioInsumos = $this->isOnOff($request->input('ver_inventario_insumos'));
        $upd_borrar_InventarioInsumos = $this->isOnOff($request->input('borrar_inventario_insumos'));
        $upd_exportar_InventarioInsumos = $this->isOnOff($request->input('exportar_inventario_insumos'));

        $upd_crear_Formularios = $this->isOnOff($request->input('crear_formularios'));
        $upd_editar_Formularios = $this->isOnOff($request->input('editar_formularios'));
        $upd_ver_Formularios = $this->isOnOff($request->input('ver_formularios'));
        $upd_borrar_Formularios = $this->isOnOff($request->input('borrar_formularios'));
        $upd_exportar_Formularios = $this->isOnOff($request->input('exportar_formularios'));

        $upd_crear_HistorialSalasAnticipadas = $this->isOnOff($request->input('crear_historial_salas_anticipadas'));
        $upd_editar_HistorialSalasAnticipadas = $this->isOnOff($request->input('editar_historial_salas_anticipadas'));
        $upd_ver_HistorialSalasAnticipadas = $this->isOnOff($request->input('ver_historial_salas_anticipadas'));
        $upd_borrar_HistorialSalasAnticipadas = $this->isOnOff($request->input('borrar_historial_salas_anticipadas'));
        $upd_exportar_HistorialSalasAnticipadas = $this->isOnOff($request->input('exportar_historial_salas_anticipadas'));

        $upd_crear_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('crear_historial_salas_reservadas_en_momento'));
        $upd_editar_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('editar_historial_salas_reservadas_en_momento'));
        $upd_ver_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('ver_historial_salas_reservadas_en_momento'));
        $upd_borrar_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('borrar_historial_salas_reservadas_en_momento'));
        $upd_exportar_HistorialSalasReservadasEnMomento = $this->isOnOff($request->input('exportar_historial_salas_reservadas_en_momento'));

        $upd_crear_HistorialEquiposAnticipados = $this->isOnOff($request->input('crear_historial_equipos_anticipados'));
        $upd_editar_HistorialEquiposAnticipados = $this->isOnOff($request->input('editar_historial_equipos_anticipados'));
        $upd_ver_HistorialEquiposAnticipados = $this->isOnOff($request->input('ver_historial_equipos_anticipados'));
        $upd_borrar_HistorialEquiposAnticipados = $this->isOnOff($request->input('borrar_historial_equipos_anticipados'));
        $upd_exportar_HistorialEquiposAnticipados = $this->isOnOff($request->input('exportar_historial_equipos_anticipados'));

        $upd_crear_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('crear_historial_equipos_reservados_en_momento'));
        $upd_editar_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('editar_historial_equipos_reservados_en_momento'));
        $upd_ver_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('ver_historial_equipos_reservados_en_momento'));
        $upd_borrar_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('borrar_historial_equipos_reservados_en_momento'));
        $upd_exportar_HistorialEquiposReservadosEnMomento = $this->isOnOff($request->input('exportar_historial_equipos_reservados_en_momento'));

        $upd_crear_ConfiguracionCorreos = $this->isOnOff('off');
        $upd_editar_ConfiguracionCorreos = $this->isOnOff('off');
        $upd_ver_ConfiguracionCorreos = $this->isOnOff($request->input('ver_configuracion_correos'));
        $upd_borrar_ConfiguracionCorreos = $this->isOnOff('off');
        $upd_exportar_ConfiguracionCorreos = $this->isOnOff($request->input('exportar_configuracion_correos'));

        $upd_crear_ConfiguracionUsuarios = $this->isOnOff('off');
        $upd_editar_ConfiguracionUsuarios = $this->isOnOff('off');
        $upd_ver_ConfiguracionUsuarios = $this->isOnOff($request->input('ver_configuracion_usuarios'));
        $upd_borrar_ConfiguracionUsuarios = $this->isOnOff('off');
        $upd_exportar_ConfiguracionUsuarios = $this->isOnOff($request->input('exportar_configuracion_usuarios'));

        $upd_crear_ConfiguracionTiposDeUsuario = $this->isOnOff('off');
        $upd_editar_ConfiguracionTiposDeUsuario = $this->isOnOff('off');
        $upd_ver_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('ver_configuracion_tipos_de_usuario'));
        $upd_borrar_ConfiguracionTiposDeUsuario = $this->isOnOff('off');
        $upd_exportar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('exportar_configuracion_tipos_de_usuario'));

        $upd_crear_ConfiguracionRoles = $this->isOnOff('off');
        $upd_editar_ConfiguracionRoles = $this->isOnOff('off');
        $upd_ver_ConfiguracionRoles = $this->isOnOff($request->input('ver_configuracion_roles'));
        $upd_borrar_ConfiguracionRoles = $this->isOnOff('off');
        $upd_exportar_ConfiguracionRoles = $this->isOnOff($request->input('exportar_configuracion_roles'));

        //Creacion de los permisos
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAR_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_ReservaSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_ReservaSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_ReservaSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_ReservaSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_ReservaSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAR_EQUIPO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_ReservaEquipos,
                            'sipa_permisos_roles_editar'=>$upd_editar_ReservaEquipos,
                            'sipa_permisos_roles_ver'=>$upd_ver_ReservaEquipos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_ReservaEquipos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_ReservaEquipos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_USO_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_InventarioEnUsoSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_InventarioEnUsoSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_InventarioEnUsoSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_InventarioEnUsoSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_InventarioEnUsoSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_USO_EQUIPO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_InventarioEnUsoEquipos,
                            'sipa_permisos_roles_editar'=>$upd_editar_InventarioEnUsoEquipos,
                            'sipa_permisos_roles_ver'=>$upd_ver_InventarioEnUsoEquipos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_InventarioEnUsoEquipos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_InventarioEnUsoEquipos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_EntregaSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_EntregaSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_EntregaSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_EntregaSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_EntregaSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);


        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_EQUIPO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_EntregaEquipos,
                            'sipa_permisos_roles_editar'=>$upd_editar_EntregaEquipos,
                            'sipa_permisos_roles_ver'=>$upd_ver_EntregaEquipos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_EntregaEquipos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_EntregaEquipos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_DevolucionSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_DevolucionSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_DevolucionSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_DevolucionSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_DevolucionSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_EQUIPO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_DevolucionEquipos,
                            'sipa_permisos_roles_editar'=>$upd_editar_DevolucionEquipos,
                            'sipa_permisos_roles_ver'=>$upd_ver_DevolucionEquipos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_DevolucionEquipos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_DevolucionEquipos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_InventarioSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_InventarioSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_InventarioSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_InventarioSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_InventarioSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_EQUIPO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_InventarioEquipos,
                            'sipa_permisos_roles_editar'=>$upd_editar_InventarioEquipos,
                            'sipa_permisos_roles_ver'=>$upd_ver_InventarioEquipos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_InventarioEquipos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_InventarioEquipos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_INSUMO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_InventarioInsumos,
                            'sipa_permisos_roles_editar'=>$upd_editar_InventarioInsumos,
                            'sipa_permisos_roles_ver'=>$upd_ver_InventarioInsumos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_InventarioInsumos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_InventarioInsumos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_FORMULARIOS')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_Formularios,
                            'sipa_permisos_roles_editar'=>$upd_editar_Formularios,
                            'sipa_permisos_roles_ver'=>$upd_ver_Formularios,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_Formularios,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_Formularios,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_ANTICIPADA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_HistorialSalasAnticipadas,
                            'sipa_permisos_roles_editar'=>$upd_editar_HistorialSalasAnticipadas,
                            'sipa_permisos_roles_ver'=>$upd_ver_HistorialSalasAnticipadas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_HistorialSalasAnticipadas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_HistorialSalasAnticipadas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_RAPIDAS')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_HistorialSalasReservadasEnMomento,
                            'sipa_permisos_roles_editar'=>$upd_editar_HistorialSalasReservadasEnMomento,
                            'sipa_permisos_roles_ver'=>$upd_ver_HistorialSalasReservadasEnMomento,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_HistorialSalasReservadasEnMomento,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_HistorialSalasReservadasEnMomento,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_ANTICIPADA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_HistorialEquiposAnticipados,
                            'sipa_permisos_roles_editar'=>$upd_editar_HistorialEquiposAnticipados,
                            'sipa_permisos_roles_ver'=>$upd_ver_HistorialEquiposAnticipados,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_HistorialEquiposAnticipados,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_HistorialEquiposAnticipados,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_RAPIDAS')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_HistorialEquiposReservadosEnMomento,
                            'sipa_permisos_roles_editar'=>$upd_editar_HistorialEquiposReservadosEnMomento,
                            'sipa_permisos_roles_ver'=>$upd_ver_HistorialEquiposReservadosEnMomento,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_HistorialEquiposReservadosEnMomento,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_HistorialEquiposReservadosEnMomento,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_CORREOS')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_ConfiguracionCorreos,
                            'sipa_permisos_roles_editar'=>$upd_editar_ConfiguracionCorreos,
                            'sipa_permisos_roles_ver'=>$upd_ver_ConfiguracionCorreos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_ConfiguracionCorreos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_ConfiguracionCorreos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_TIPO_USUARIOS')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_ConfiguracionUsuarios,
                            'sipa_permisos_roles_editar'=>$upd_editar_ConfiguracionUsuarios,
                            'sipa_permisos_roles_ver'=>$upd_ver_ConfiguracionUsuarios,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_ConfiguracionUsuarios,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_ConfiguracionUsuarios,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_USUARIOS')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_ConfiguracionTiposDeUsuario,
                            'sipa_permisos_roles_editar'=>$upd_editar_ConfiguracionTiposDeUsuario,
                            'sipa_permisos_roles_ver'=>$upd_ver_ConfiguracionTiposDeUsuario,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_ConfiguracionTiposDeUsuario,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_ConfiguracionTiposDeUsuario,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_ROLES')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_ConfiguracionRoles,
                            'sipa_permisos_roles_editar'=>$upd_editar_ConfiguracionRoles,
                            'sipa_permisos_roles_ver'=>$upd_ver_ConfiguracionRoles,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_ConfiguracionRoles,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_ConfiguracionRoles,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
    }

    public function borrarPermisos(Rol $upd_rol){
        //Creacion de los permisos
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAR_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAR_EQUIPO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_USO_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_USO_EQUIPO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_EQUIPO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_EQUIPO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_EQUIPO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_INSUMO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_FORMULARIOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_ANTICIPADA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_RAPIDAS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_ANTICIPADA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA_RAPIDAS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_CORREOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_TIPO_USUARIOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_USUARIOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_ROLES')->get()[0];
        $permiso->delete();
    }
  }
