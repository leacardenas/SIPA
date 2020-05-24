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
            #return redirect()->route('inventarioactivos');
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
          $menu_Reserva = Modulo::where('sipa_opciones_menu_codigo','RESERVAR')->get()[0];
          $menu_Inventario = Modulo::where('sipa_opciones_menu_codigo','INV')->get()[0];
          $menu_Entrega = Modulo::where('sipa_opciones_menu_codigo','ENTREG')->get()[0];
          $menu_Devolucion = Modulo::where('sipa_opciones_menu_codigo','DEVOLU')->get()[0];
          $menu_Historial = Modulo::where('sipa_opciones_menu_codigo','HISTO')->get()[0];
          $menu_Configuracion = Modulo::where('sipa_opciones_menu_codigo','CONFIG')->get()[0];
          $menu_miInventario = Modulo::where('sipa_opciones_menu_codigo','MI_INV')->get()[0];
          $menu_misReservas = Modulo::where('sipa_opciones_menu_codigo','MIS_RESERVAS')->get()[0];
          $menu_ReservasGeneral = Modulo::where('sipa_opciones_menu_codigo','RESERVAS')->get()[0];

          $crear_ReservaSalas = $this->isOnOff($request->input('crear_reserva_salas'));
          $editar_ReservaSalas = $this->isOnOff($request->input('editar_reserva_salas'));
          $ver_ReservaSalas = $this->isOnOff($request->input('ver_reserva_salas'));
          $borrar_ReservaSalas = $this->isOnOff($request->input('borrar_reserva_salas'));
          $exportar_ReservaSalas = $this->isOnOff($request->input('exportar_reserva_salas'));
          $menu_ReservaSalas = Modulo::where('sipa_opciones_menu_codigo','RESERVAR_SALA')->get()[0];

          $crear_Reservaactivos = $this->isOnOff($request->input('crear_reserva_activos'));
          $editar_Reservaactivos = $this->isOnOff($request->input('editar_reserva_activos'));
          $ver_Reservaactivos = $this->isOnOff($request->input('ver_reserva_activos'));
          $borrar_Reservaactivos = $this->isOnOff($request->input('borrar_reserva_activos'));
          $exportar_Reservaactivos = $this->isOnOff($request->input('exportar_reserva_activos'));
          $menu_Reservaactivos = Modulo::where('sipa_opciones_menu_codigo','RESERVAR_ACTIVO')->get()[0];

          $crear_MisReservasSalas = $this->isOnOff($request->input('crear_mis_reservas_salas'));
          $editar_MisReservasSalas = $this->isOnOff($request->input('editar_mis_reservas_salas'));
          $ver_MisReservasSalas = $this->isOnOff($request->input('ver_mis_reservas_salas'));
          $borrar_MisReservasSalas = $this->isOnOff($request->input('borrar_mis_reservas_salas'));
          $exportar_MisReservasSalas = $this->isOnOff($request->input('exportar_mis_reservas_salas'));
          $menu_MisReservasSalas = Modulo::where('sipa_opciones_menu_codigo','MIS_RESERVAS_SALA')->get()[0];

          $crear_MisReservasactivos = $this->isOnOff($request->input('crear_mis_reservas_activos'));
          $editar_MisReservasactivos = $this->isOnOff($request->input('editar_mis_reservas_activos'));
          $ver_MisReservasactivos = $this->isOnOff($request->input('ver_mis_reservas_activos'));
          $borrar_MisReservasactivos = $this->isOnOff($request->input('borrar_mis_reservas_activos'));
          $exportar_MisReservasactivos = $this->isOnOff($request->input('exportar_mis_reservas_activos'));
          $menu_MisReservasactivos = Modulo::where('sipa_opciones_menu_codigo','MIS_RESERVAS_ACTIVO')->get()[0];

          $crear_EntregaSalas = $this->isOnOff($request->input('crear_entrega_salas'));
          $editar_EntregaSalas = $this->isOnOff($request->input('editar_entrega_salas'));
          $ver_EntregaSalas = $this->isOnOff($request->input('ver_entrega_salas'));
          $borrar_EntregaSalas = $this->isOnOff($request->input('borrar_entrega_salas'));
          $exportar_EntregaSalas = $this->isOnOff($request->input('exportar_entrega_salas'));
          $menu_EntregaSalas = Modulo::where('sipa_opciones_menu_codigo','ENTREG_SALA')->get()[0];

          $crear_Entregaactivos = $this->isOnOff($request->input('crear_entrega_activos'));
          $editar_Entregaactivos = $this->isOnOff($request->input('editar_entrega_activos'));
          $ver_Entregaactivos = $this->isOnOff($request->input('ver_entrega_activos'));
          $borrar_Entregaactivos = $this->isOnOff($request->input('borrar_entrega_activos'));
          $exportar_Entregaactivos = $this->isOnOff($request->input('exportar_entrega_activos'));
          $menu_Entregaactivos = Modulo::where('sipa_opciones_menu_codigo','ENTREG_ACTIVO')->get()[0];

          $crear_DevolucionSalas = $this->isOnOff($request->input('crear_devolucion_salas'));
          $editar_DevolucionSalas = $this->isOnOff($request->input('editar_devolucion_salas'));
          $ver_DevolucionSalas = $this->isOnOff($request->input('ver_devolucion_salas'));
          $borrar_DevolucionSalas = $this->isOnOff($request->input('borrar_devolucion_salas'));
          $exportar_DevolucionSalas = $this->isOnOff($request->input('exportar_devolucion_salas'));
          $menu_DevolucionSalas = Modulo::where('sipa_opciones_menu_codigo','DEVOLU_SALA')->get()[0];

          $crear_Devolucionactivos = $this->isOnOff($request->input('crear_devolucion_activos'));
          $editar_Devolucionactivos = $this->isOnOff($request->input('editar_devolucion_activos'));
          $ver_Devolucionactivos = $this->isOnOff($request->input('ver_devolucion_activos'));
          $borrar_Devolucionactivos = $this->isOnOff($request->input('borrar_devolucion_activos'));
          $exportar_Devolucionactivos = $this->isOnOff($request->input('exportar_devolucion_activos'));
          $menu_Devolucionactivos = Modulo::where('sipa_opciones_menu_codigo','DEVOLU_ACTIVO')->get()[0];

          $crear_InventarioSalas = $this->isOnOff($request->input('crear_inventario_salas'));
          $editar_InventarioSalas = $this->isOnOff($request->input('editar_inventario_salas'));
          $ver_InventarioSalas = $this->isOnOff($request->input('ver_inventario_salas'));
          $borrar_InventarioSalas = $this->isOnOff($request->input('borrar_inventario_salas'));
          $exportar_InventarioSalas = $this->isOnOff($request->input('exportar_inventario_salas'));
          $menu_InventarioSalas = Modulo::where('sipa_opciones_menu_codigo','INV_SALA')->get()[0];

          $crear_Inventarioactivos = $this->isOnOff($request->input('crear_inventario_activos'));
          $editar_Inventarioactivos = $this->isOnOff($request->input('editar_inventario_activos'));
          $ver_Inventarioactivos = $this->isOnOff($request->input('ver_inventario_activos'));
          $borrar_Inventarioactivos = $this->isOnOff($request->input('borrar_inventario_activos'));
          $exportar_Inventarioactivos = $this->isOnOff($request->input('exportar_inventario_activos'));
          $menu_Inventarioactivos = Modulo::where('sipa_opciones_menu_codigo','INV_ACTIVO')->get()[0];

          $crear_InventarioInsumos = $this->isOnOff($request->input('crear_inventario_insumos'));
          $editar_InventarioInsumos = $this->isOnOff($request->input('editar_inventario_insumos'));
          $ver_InventarioInsumos = $this->isOnOff($request->input('ver_inventario_insumos'));
          $borrar_InventarioInsumos = $this->isOnOff($request->input('borrar_inventario_insumos'));
          $exportar_InventarioInsumos = $this->isOnOff($request->input('exportar_inventario_insumos'));
          $menu_InventarioInsumos = Modulo::where('sipa_opciones_menu_codigo','INV_INSUMO')->get()[0];

          $crear_MiInventarioactivos = $this->isOnOff($request->input('crear_mi_inventario_activo'));
          $editar_MiInventarioactivos = $this->isOnOff($request->input('editar_mi_inventario_activo'));
          $ver_MiInventarioactivos = $this->isOnOff($request->input('ver_mi_inventario_activo'));
          $borrar_MiInventarioactivos = $this->isOnOff($request->input('borrar_mi_inventario_activo'));
          $exportar_MiInventarioactivos = $this->isOnOff($request->input('exportar_mi_inventario_activo'));
          $menu_MiInventarioactivos = Modulo::where('sipa_opciones_menu_codigo','MI_INV_ACTIVO')->get()[0];

          $crear_HistorialSalas = $this->isOnOff($request->input('crear_historial_salas'));
          $editar_HistorialSalas = $this->isOnOff($request->input('editar_historial_salas'));
          $ver_HistorialSalas = $this->isOnOff($request->input('ver_historial_salas'));
          $borrar_HistorialSalas = $this->isOnOff($request->input('borrar_historial_salas'));
          $exportar_HistorialSalas = $this->isOnOff($request->input('exportar_historial_salas'));
          $menu_HistorialSalas = Modulo::where('sipa_opciones_menu_codigo','HISTO_SALA')->get()[0];

          $crear_Historialactivos = $this->isOnOff($request->input('crear_historial_activos'));
          $editar_Historialactivos = $this->isOnOff($request->input('editar_historial_activos'));
          $ver_Historialactivos = $this->isOnOff($request->input('ver_historial_activos'));
          $borrar_Historialactivos = $this->isOnOff($request->input('borrar_historial_activos'));
          $exportar_Historialactivos = $this->isOnOff($request->input('exportar_historial_activos'));
          $menu_Historialactivos = Modulo::where('sipa_opciones_menu_codigo','HISTO_ACTIVO')->get()[0];

          $crear_ConfiguracionCorreos = $this->isOnOff($request->input('crear_configuracion_correos'));
          $editar_ConfiguracionCorreos = $this->isOnOff($request->input('editar_configuracion_correos'));
          $ver_ConfiguracionCorreos = $this->isOnOff($request->input('ver_configuracion_correos'));
          $borrar_ConfiguracionCorreos = $this->isOnOff($request->input('borrar_configuracion_correos'));
          $exportar_ConfiguracionCorreos = $this->isOnOff($request->input('exportar_configuracion_correos'));
          $menu_ConfiguracionCorreos = Modulo::where('sipa_opciones_menu_codigo','CONFIG_CORREOS')->get()[0];

          $crear_ConfiguracionUsuarios = $this->isOnOff($request->input('crear_configuracion_usuarios'));
          $editar_ConfiguracionUsuarios = $this->isOnOff($request->input('editar_configuracion_usuarios'));
          $ver_ConfiguracionUsuarios = $this->isOnOff($request->input('ver_configuracion_usuarios'));
          $borrar_ConfiguracionUsuarios = $this->isOnOff($request->input('borrar_configuracion_usuarios'));
          $exportar_ConfiguracionUsuarios = $this->isOnOff($request->input('exportar_configuracion_usuarios'));
          $menu_ConfiguracionUsuarios = Modulo::where('sipa_opciones_menu_codigo','CONFIG_TIPO_USUARIOS')->get()[0];

          $crear_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('crear_configuracion_tipos_de_usuario'));
          $editar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('editar_configuracion_tipos_de_usuario'));
          $ver_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('ver_configuracion_tipos_de_usuario'));
          $borrar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('borrar_configuracion_tipos_de_usuario'));
          $exportar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('exportar_configuracion_tipos_de_usuario'));
          $menu_ConfiguracionTiposDeUsuario = Modulo::where('sipa_opciones_menu_codigo','CONFIG_USUARIOS')->get()[0];

          $crear_ConfiguracionRoles = $this->isOnOff($request->input('crear_configuracion_roles'));
          $editar_ConfiguracionRoles = $this->isOnOff($request->input('editar_configuracion_roles'));
          $ver_ConfiguracionRoles = $this->isOnOff($request->input('ver_configuracion_roles'));
          $borrar_ConfiguracionRoles = $this->isOnOff($request->input('borrar_configuracion_roles'));
          $exportar_ConfiguracionRoles = $this->isOnOff($request->input('exportar_configuracion_roles'));
          $menu_ConfiguracionRoles = Modulo::where('sipa_opciones_menu_codigo','CONFIG_ROLES')->get()[0];

          //Creacion de los permisos
          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Reserva->sipa_opciones_menu_id ;
          if($crear_ReservaSalas || $editar_ReservaSalas || $ver_ReservaSalas || $borrar_ReservaSalas || $exportar_ReservaSalas || 
          $crear_Reservaactivos || $editar_Reservaactivos || $ver_Reservaactivos || $borrar_Reservaactivos || $exportar_Reservaactivos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Reserva->sipa_opciones_menu_codigo;
          $permiso->save();

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

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Reservaactivos->sipa_opciones_menu_id;
          $permiso->sipa_permisos_roles_crear = $crear_Reservaactivos;
          $permiso->sipa_permisos_roles_editar = $editar_Reservaactivos;
          $permiso->sipa_permisos_roles_ver = $ver_Reservaactivos;
          $permiso->sipa_permisos_roles_borrar = $borrar_Reservaactivos;
          $permiso->sipa_permisos_roles_exportar = $exportar_Reservaactivos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Reservaactivos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_misReservas->sipa_opciones_menu_id ;
          if($crear_MisReservasSalas || $editar_MisReservasSalas || $ver_MisReservasSalas || $borrar_MisReservasSalas || $exportar_MisReservasSalas || 
          $crear_MisReservasactivos || $editar_MisReservasactivos || $ver_MisReservasactivos || $borrar_MisReservasactivos || $exportar_MisReservasactivos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_misReservas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_MisReservasSalas->sipa_opciones_menu_id ;
          $permiso->sipa_permisos_roles_crear = $crear_MisReservasSalas;
          $permiso->sipa_permisos_roles_editar = $editar_MisReservasSalas;
          $permiso->sipa_permisos_roles_ver = $ver_MisReservasSalas;
          $permiso->sipa_permisos_roles_borrar = $borrar_MisReservasSalas;
          $permiso->sipa_permisos_roles_exportar = $exportar_MisReservasSalas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_MisReservasSalas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_MisReservasactivos->sipa_opciones_menu_id;
          $permiso->sipa_permisos_roles_crear = $crear_MisReservasactivos;
          $permiso->sipa_permisos_roles_editar = $editar_MisReservasactivos;
          $permiso->sipa_permisos_roles_ver = $ver_MisReservasactivos;
          $permiso->sipa_permisos_roles_borrar = $borrar_MisReservasactivos;
          $permiso->sipa_permisos_roles_exportar = $exportar_MisReservasactivos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_MisReservasactivos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_ReservasGeneral->sipa_opciones_menu_id ;
          if($crear_EntregaSalas || $editar_EntregaSalas || $ver_EntregaSalas || $borrar_EntregaSalas || $exportar_EntregaSalas || 
          $crear_Entregaactivos || $editar_Entregaactivos || $ver_Entregaactivos || $borrar_Entregaactivos || $exportar_Entregaactivos ||
          $crear_DevolucionSalas || $editar_DevolucionSalas || $ver_DevolucionSalas || $borrar_DevolucionSalas || $exportar_DevolucionSalas || 
          $crear_Devolucionactivos || $editar_Devolucionactivos || $ver_Devolucionactivos || $borrar_Devolucionactivos || $exportar_Devolucionactivos ||
          $crear_HistorialSalas || $editar_HistorialSalas || $ver_HistorialSalas || $borrar_HistorialSalas || $exportar_HistorialSalas || 
          $crear_Historialactivos || $editar_Historialactivos || $ver_Historialactivos || $borrar_Historialactivos || $exportar_Historialactivos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_ReservasGeneral->sipa_opciones_menu_codigo;
          $permiso->save();
          
          $permiso->sipa_permisos_roles_opciones_menu = $menu_Entrega->sipa_opciones_menu_id ;
          if($crear_EntregaSalas || $editar_EntregaSalas || $ver_EntregaSalas || $borrar_EntregaSalas || $exportar_EntregaSalas || 
          $crear_Entregaactivos || $editar_Entregaactivos || $ver_Entregaactivos || $borrar_Entregaactivos || $exportar_Entregaactivos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Entrega->sipa_opciones_menu_codigo;
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

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Entregaactivos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_Entregaactivos;
          $permiso->sipa_permisos_roles_editar = $editar_Entregaactivos;
          $permiso->sipa_permisos_roles_ver = $ver_Entregaactivos;
          $permiso->sipa_permisos_roles_borrar = $borrar_Entregaactivos;
          $permiso->sipa_permisos_roles_exportar = $exportar_Entregaactivos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Entregaactivos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Devolucion->sipa_opciones_menu_id ;
          if($crear_DevolucionSalas || $editar_DevolucionSalas || $ver_DevolucionSalas || $borrar_DevolucionSalas || $exportar_DevolucionSalas || 
          $crear_Devolucionactivos || $editar_Devolucionactivos || $ver_Devolucionactivos || $borrar_Devolucionactivos || $exportar_Devolucionactivos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Devolucion->sipa_opciones_menu_codigo;
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

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Devolucionactivos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_Devolucionactivos;
          $permiso->sipa_permisos_roles_editar = $editar_Devolucionactivos;
          $permiso->sipa_permisos_roles_ver = $ver_Devolucionactivos;
          $permiso->sipa_permisos_roles_borrar = $borrar_Devolucionactivos;
          $permiso->sipa_permisos_roles_exportar = $exportar_Devolucionactivos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Devolucionactivos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Inventario->sipa_opciones_menu_id ;
          if($crear_InventarioSalas || $editar_InventarioSalas || $ver_InventarioSalas || $borrar_InventarioSalas || $exportar_InventarioSalas || 
          $crear_Inventarioactivos || $editar_Inventarioactivos || $ver_Inventarioactivos || $borrar_Inventarioactivos || $exportar_Inventarioactivos ||
          $crear_InventarioInsumos || $editar_InventarioInsumos || $ver_InventarioInsumos || $borrar_InventarioInsumos || $exportar_InventarioInsumos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Inventario->sipa_opciones_menu_codigo;
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

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Inventarioactivos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_Inventarioactivos;
          $permiso->sipa_permisos_roles_editar = $editar_Inventarioactivos;
          $permiso->sipa_permisos_roles_ver = $ver_Inventarioactivos;
          $permiso->sipa_permisos_roles_borrar = $borrar_Inventarioactivos;
          $permiso->sipa_permisos_roles_exportar = $exportar_Inventarioactivos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Inventarioactivos->sipa_opciones_menu_codigo;
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

          $permiso->sipa_permisos_roles_opciones_menu = $menu_miInventario->sipa_opciones_menu_id ;
          if($crear_MiInventarioactivos || $editar_MiInventarioactivos || $ver_MiInventarioactivos || $borrar_MiInventarioactivos || $exportar_MiInventarioactivos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_miInventario->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_MiInventarioactivos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_MiInventarioactivos;
          $permiso->sipa_permisos_roles_editar = $editar_MiInventarioactivos;
          $permiso->sipa_permisos_roles_ver = $ver_MiInventarioactivos;
          $permiso->sipa_permisos_roles_borrar = $borrar_MiInventarioactivos;
          $permiso->sipa_permisos_roles_exportar = $exportar_MiInventarioactivos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_MiInventarioactivos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Historial->sipa_opciones_menu_id ;
          if($crear_HistorialSalas || $editar_HistorialSalas || $ver_HistorialSalas || $borrar_HistorialSalas || $exportar_HistorialSalas || 
          $crear_Historialactivos || $editar_Historialactivos || $ver_Historialactivos || $borrar_Historialactivos || $exportar_Historialactivos){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Historial->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_HistorialSalas->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_HistorialSalas;
          $permiso->sipa_permisos_roles_editar = $editar_HistorialSalas;
          $permiso->sipa_permisos_roles_ver = $ver_HistorialSalas;
          $permiso->sipa_permisos_roles_borrar = $borrar_HistorialSalas;
          $permiso->sipa_permisos_roles_exportar = $exportar_HistorialSalas;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_HistorialSalas->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Historialactivos->sipa_opciones_menu_id   ;
          $permiso->sipa_permisos_roles_crear = $crear_Historialactivos;
          $permiso->sipa_permisos_roles_editar = $editar_Historialactivos;
          $permiso->sipa_permisos_roles_ver = $ver_Historialactivos;
          $permiso->sipa_permisos_roles_borrar = $borrar_Historialactivos;
          $permiso->sipa_permisos_roles_exportar = $exportar_Historialactivos;
          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Historialactivos->sipa_opciones_menu_codigo;
          $permiso->save();

          $permiso = new Permiso;
          $permiso->sipa_permisos_roles_role = $rol->sipa_roles_id;
          $permiso->sipa_permisos_roles_usuario_creador = $usuario->sipa_usuarios_id;

          $permiso->sipa_permisos_roles_opciones_menu = $menu_Configuracion->sipa_opciones_menu_id ;
          if($crear_ConfiguracionCorreos || $editar_ConfiguracionCorreos || $ver_ConfiguracionCorreos || $borrar_ConfiguracionCorreos || $exportar_ConfiguracionCorreos || 
          $crear_ConfiguracionUsuarios || $editar_ConfiguracionUsuarios || $ver_ConfiguracionUsuarios || $borrar_ConfiguracionUsuarios || $exportar_ConfiguracionUsuarios ||
          $crear_ConfiguracionTiposDeUsuario || $editar_ConfiguracionTiposDeUsuario || $ver_ConfiguracionTiposDeUsuario || $borrar_ConfiguracionTiposDeUsuario || $exportar_ConfiguracionTiposDeUsuario ||
          $crear_ConfiguracionRoles || $editar_ConfiguracionRoles || $ver_ConfiguracionRoles || $borrar_ConfiguracionRoles || $exportar_ConfiguracionRoles){
            $permiso->sipa_permisos_roles_crear = true;
            $permiso->sipa_permisos_roles_editar = true;
            $permiso->sipa_permisos_roles_ver = true;
            $permiso->sipa_permisos_roles_borrar = true;
            $permiso->sipa_permisos_roles_exportar = true;
          }else{
            $permiso->sipa_permisos_roles_crear = false;
            $permiso->sipa_permisos_roles_editar = false;
            $permiso->sipa_permisos_roles_ver = false;
            $permiso->sipa_permisos_roles_borrar = false;
            $permiso->sipa_permisos_roles_exportar = false;
          }

          $permiso->sipa_permisos_roles_opcion_menu_codigo = $menu_Configuracion->sipa_opciones_menu_codigo;
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

          $upd_crear_Reservaactivos = $this->isOnOff($request->input('crear_reserva_activos'));
          $upd_editar_Reservaactivos = $this->isOnOff($request->input('editar_reserva_activos'));
          $upd_ver_Reservaactivos = $this->isOnOff($request->input('ver_reserva_activos'));
          $upd_borrar_Reservaactivos = $this->isOnOff($request->input('borrar_reserva_activos'));
          $upd_exportar_Reservaactivos = $this->isOnOff($request->input('exportar_reserva_activos'));

          $upd_crear_MisReservasSalas = $this->isOnOff($request->input('crear_mis_reservas_salas'));
          $upd_editar_MisReservasSalas = $this->isOnOff($request->input('editar_mis_reservas_salas'));
          $upd_ver_MisReservasSalas = $this->isOnOff($request->input('ver_mis_reservas_salas'));
          $upd_borrar_MisReservasSalas = $this->isOnOff($request->input('borrar_mis_reservas_salas'));
          $upd_exportar_MisReservasSalas = $this->isOnOff($request->input('exportar_mis_reservas_salas'));

          $upd_crear_MisReservasactivos = $this->isOnOff($request->input('crear_mis_reservas_activos'));
          $upd_editar_MisReservasactivos = $this->isOnOff($request->input('editar_mis_reservas_activos'));
          $upd_ver_MisReservasactivos = $this->isOnOff($request->input('ver_mis_reservas_activos'));
          $upd_borrar_MisReservasactivos = $this->isOnOff($request->input('borrar_mis_reservas_activos'));
          $upd_exportar_MisReservasactivos = $this->isOnOff($request->input('exportar_mis_reservas_activos'));

          $upd_crear_EntregaSalas = $this->isOnOff($request->input('crear_entrega_salas'));
          $upd_editar_EntregaSalas = $this->isOnOff($request->input('editar_entrega_salas'));
          $upd_ver_EntregaSalas = $this->isOnOff($request->input('ver_entrega_salas'));
          $upd_borrar_EntregaSalas = $this->isOnOff($request->input('borrar_entrega_salas'));
          $upd_exportar_EntregaSalas = $this->isOnOff($request->input('exportar_entrega_salas'));

          $upd_crear_Entregaactivos = $this->isOnOff($request->input('crear_entrega_activos'));
          $upd_editar_Entregaactivos = $this->isOnOff($request->input('editar_entrega_activos'));
          $upd_ver_Entregaactivos = $this->isOnOff($request->input('ver_entrega_activos'));
          $upd_borrar_Entregaactivos = $this->isOnOff($request->input('borrar_entrega_activos'));
          $upd_exportar_Entregaactivos = $this->isOnOff($request->input('exportar_entrega_activos'));

          $upd_crear_DevolucionSalas = $this->isOnOff($request->input('crear_devolucion_salas'));
          $upd_editar_DevolucionSalas = $this->isOnOff($request->input('editar_devolucion_salas'));
          $upd_ver_DevolucionSalas = $this->isOnOff($request->input('ver_devolucion_salas'));
          $upd_borrar_DevolucionSalas = $this->isOnOff($request->input('borrar_devolucion_salas'));
          $upd_exportar_DevolucionSalas = $this->isOnOff($request->input('exportar_devolucion_salas'));

          $upd_crear_Devolucionactivos = $this->isOnOff($request->input('crear_devolucion_activos'));
          $upd_editar_Devolucionactivos = $this->isOnOff($request->input('editar_devolucion_activos'));
          $upd_ver_Devolucionactivos = $this->isOnOff($request->input('ver_devolucion_activos'));
          $upd_borrar_Devolucionactivos = $this->isOnOff($request->input('borrar_devolucion_activos'));
          $upd_exportar_Devolucionactivos = $this->isOnOff($request->input('exportar_devolucion_activos'));

          $upd_crear_InventarioSalas = $this->isOnOff($request->input('crear_inventario_salas'));
          $upd_editar_InventarioSalas = $this->isOnOff($request->input('editar_inventario_salas'));
          $upd_ver_InventarioSalas = $this->isOnOff($request->input('ver_inventario_salas'));
          $upd_borrar_InventarioSalas = $this->isOnOff($request->input('borrar_inventario_salas'));
          $upd_exportar_InventarioSalas = $this->isOnOff($request->input('exportar_inventario_salas'));

          $upd_crear_Inventarioactivos = $this->isOnOff($request->input('crear_inventario_activos'));
          $upd_editar_Inventarioactivos = $this->isOnOff($request->input('editar_inventario_activos'));
          $upd_ver_Inventarioactivos = $this->isOnOff($request->input('ver_inventario_activos'));
          $upd_borrar_Inventarioactivos = $this->isOnOff($request->input('borrar_inventario_activos'));
          $upd_exportar_Inventarioactivos = $this->isOnOff($request->input('exportar_inventario_activos'));

          $upd_crear_InventarioInsumos = $this->isOnOff($request->input('crear_inventario_insumos'));
          $upd_editar_InventarioInsumos = $this->isOnOff($request->input('editar_inventario_insumos'));
          $upd_ver_InventarioInsumos = $this->isOnOff($request->input('ver_inventario_insumos'));
          $upd_borrar_InventarioInsumos = $this->isOnOff($request->input('borrar_inventario_insumos'));
          $upd_exportar_InventarioInsumos = $this->isOnOff($request->input('exportar_inventario_insumos'));

          $upd_crear_MiInventarioactivos = $this->isOnOff($request->input('crear_mi_inventario_activos'));
          $upd_editar_MiInventarioactivos = $this->isOnOff($request->input('editar_mi_inventario_activos'));
          $upd_ver_MiInventarioactivos = $this->isOnOff($request->input('ver_mi_inventario_activos'));
          $upd_borrar_MiInventarioactivos = $this->isOnOff($request->input('borrar_mi_inventario_activos'));
          $upd_exportar_MiInventarioactivos = $this->isOnOff($request->input('exportar_mi_inventario_activos'));

          $upd_crear_HistorialSalas = $this->isOnOff($request->input('crear_historial_salas'));
          $upd_editar_HistorialSalas = $this->isOnOff($request->input('editar_historial_salas'));
          $upd_ver_HistorialSalas = $this->isOnOff($request->input('ver_historial_salas'));
          $upd_borrar_HistorialSalas = $this->isOnOff($request->input('borrar_historial_salas'));
          $upd_exportar_HistorialSalas = $this->isOnOff($request->input('exportar_historial_salas'));

          $upd_crear_Historialactivos = $this->isOnOff($request->input('crear_historial_activos'));
          $upd_editar_Historialactivos = $this->isOnOff($request->input('editar_historial_activos'));
          $upd_ver_Historialactivos = $this->isOnOff($request->input('ver_historial_activos'));
          $upd_borrar_Historialactivos = $this->isOnOff($request->input('borrar_historial_activos'));
          $upd_exportar_Historialactivos = $this->isOnOff($request->input('exportar_historial_activos'));

          $upd_crear_ConfiguracionCorreos = $this->isOnOff($request->input('crear_configuracion_correos'));
          $upd_editar_ConfiguracionCorreos = $this->isOnOff($request->input('editar_configuracion_correos'));
          $upd_ver_ConfiguracionCorreos = $this->isOnOff($request->input('ver_configuracion_correos'));
          $upd_borrar_ConfiguracionCorreos = $this->isOnOff($request->input('borrar_configuracion_correos'));
          $upd_exportar_ConfiguracionCorreos = $this->isOnOff($request->input('exportar_configuracion_correos'));

          $upd_crear_ConfiguracionUsuarios = $this->isOnOff($request->input('crear_configuracion_usuarios'));
          $upd_editar_ConfiguracionUsuarios = $this->isOnOff($request->input('editar_configuracion_usuarios'));
          $upd_ver_ConfiguracionUsuarios = $this->isOnOff($request->input('ver_configuracion_usuarios'));
          $upd_borrar_ConfiguracionUsuarios = $this->isOnOff($request->input('borrar_configuracion_usuarios'));
          $upd_exportar_ConfiguracionUsuarios = $this->isOnOff($request->input('exportar_configuracion_usuarios'));

          $upd_crear_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('crear_configuracion_tipos_de_usuario'));
          $upd_editar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('editar_configuracion_tipos_de_usuario'));
          $upd_ver_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('ver_configuracion_tipos_de_usuario'));
          $upd_borrar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('borrar_configuracion_tipos_de_usuario'));
          $upd_exportar_ConfiguracionTiposDeUsuario = $this->isOnOff($request->input('exportar_configuracion_tipos_de_usuario'));

          $upd_crear_ConfiguracionRoles = $this->isOnOff($request->input('crear_configuracion_roles'));
          $upd_editar_ConfiguracionRoles = $this->isOnOff($request->input('editar_configuracion_roles'));
          $upd_ver_ConfiguracionRoles = $this->isOnOff($request->input('ver_configuracion_roles'));
          $upd_borrar_ConfiguracionRoles = $this->isOnOff($request->input('borrar_configuracion_roles'));
          $upd_exportar_ConfiguracionRoles = $this->isOnOff($request->input('exportar_configuracion_roles'));

          //Editar los permisos
          $permiso = Permiso::where('sipa_permisos_roles_role', $upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo', 'RESERVAR')->get()[0];
          if ($upd_crear_ReservaSalas || $upd_editar_ReservaSalas || $upd_ver_ReservaSalas || $upd_borrar_ReservaSalas || $upd_exportar_ReservaSalas ||
          $upd_crear_Reservaactivos || $upd_editar_Reservaactivos || $upd_ver_Reservaactivos || $upd_borrar_Reservaactivos || $upd_exportar_Reservaactivos) {
              $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else {
              $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

          $permiso = Permiso::where('sipa_permisos_roles_role', $upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo', 'RESERVAR_SALA')->get()[0];
          $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_ReservaSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_ReservaSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_ReservaSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_ReservaSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_ReservaSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

          $permiso = Permiso::where('sipa_permisos_roles_role', $upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo', 'RESERVAR_ACTIVO')->get()[0];
          $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_Reservaactivos,
                            'sipa_permisos_roles_editar'=>$upd_editar_Reservaactivos,
                            'sipa_permisos_roles_ver'=>$upd_ver_Reservaactivos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_Reservaactivos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_Reservaactivos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

          $permiso = Permiso::where('sipa_permisos_roles_role', $upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo', 'MIS_RESERVAS')->get()[0];
          if ($upd_crear_MisReservasSalas || $upd_editar_MisReservasSalas || $upd_ver_MisReservasSalas || $upd_borrar_MisReservasSalas || $upd_exportar_MisReservasSalas ||
          $upd_crear_MisReservasactivos || $upd_editar_MisReservasactivos || $upd_ver_MisReservasactivos || $upd_borrar_MisReservasactivos || $upd_exportar_MisReservasactivos) {
              $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else {
              $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

          $permiso = Permiso::where('sipa_permisos_roles_role', $upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo', 'MIS_RESERVAS_SALA')->get()[0];
          $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_MisReservasSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_MisReservasSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_MisReservasSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_MisReservasSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_MisReservasSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

          $permiso = Permiso::where('sipa_permisos_roles_role', $upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo', 'MIS_RESERVAS_ACTIVO')->get()[0];
          $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_MisReservasactivos,
                            'sipa_permisos_roles_editar'=>$upd_editar_MisReservasactivos,
                            'sipa_permisos_roles_ver'=>$upd_ver_MisReservasactivos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_MisReservasactivos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_MisReservasactivos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

         $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAS')->get()[0];
          if($upd_crear_EntregaSalas || $upd_editar_EntregaSalas || $upd_ver_EntregaSalas || $upd_borrar_EntregaSalas || $upd_exportar_EntregaSalas || 
          $upd_crear_Entregaactivos || $upd_editar_Entregaactivos || $upd_ver_Entregaactivos || $upd_borrar_Entregaactivos || $upd_exportar_Entregaactivos ||
          $upd_crear_DevolucionSalas || $upd_editar_DevolucionSalas || $upd_ver_DevolucionSalas || $upd_borrar_DevolucionSalas || $upd_exportar_DevolucionSalas || 
          $upd_crear_Devolucionactivos || $upd_editar_Devolucionactivos || $upd_ver_Devolucionactivos || $upd_borrar_Devolucionactivos || $upd_exportar_Devolucionactivos ||
          $upd_crear_HistorialSalas || $upd_editar_HistorialSalas || $upd_ver_HistorialSalas || $upd_borrar_HistorialSalas || $upd_exportar_HistorialSalas || 
          $upd_crear_Historialactivos || $upd_editar_Historialactivos || $upd_ver_Historialactivos || $upd_borrar_Historialactivos || $upd_exportar_Historialactivos){
            $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else{
            $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

          $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG')->get()[0];
          if($upd_crear_EntregaSalas || $upd_editar_EntregaSalas || $upd_ver_EntregaSalas || $upd_borrar_EntregaSalas || $upd_exportar_EntregaSalas || 
          $upd_crear_Entregaactivos || $upd_editar_Entregaactivos || $upd_ver_Entregaactivos || $upd_borrar_Entregaactivos || $upd_exportar_Entregaactivos){
            $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else{
            $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_EntregaSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_EntregaSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_EntregaSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_EntregaSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_EntregaSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);


        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_ACTIVO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_Entregaactivos,
                            'sipa_permisos_roles_editar'=>$upd_editar_Entregaactivos,
                            'sipa_permisos_roles_ver'=>$upd_ver_Entregaactivos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_Entregaactivos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_Entregaactivos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU')->get()[0];
        if($upd_crear_DevolucionSalas || $upd_editar_DevolucionSalas || $upd_ver_DevolucionSalas || $upd_borrar_DevolucionSalas || $upd_exportar_DevolucionSalas || 
        $upd_crear_Devolucionactivos || $upd_editar_Devolucionactivos || $upd_ver_Devolucionactivos || $upd_borrar_Devolucionactivos || $upd_exportar_Devolucionactivos){
         $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else{
            $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_DevolucionSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_DevolucionSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_DevolucionSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_DevolucionSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_DevolucionSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_ACTIVO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_Devolucionactivos,
                            'sipa_permisos_roles_editar'=>$upd_editar_Devolucionactivos,
                            'sipa_permisos_roles_ver'=>$upd_ver_Devolucionactivos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_Devolucionactivos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_Devolucionactivos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV')->get()[0];
        if($upd_crear_InventarioSalas || $upd_editar_InventarioSalas || $upd_ver_InventarioSalas || $upd_borrar_InventarioSalas || $upd_exportar_InventarioSalas || 
          $upd_crear_Inventarioactivos || $upd_editar_Inventarioactivos || $upd_ver_Inventarioactivos || $upd_borrar_Inventarioactivos || $upd_exportar_Inventarioactivos ||
          $upd_crear_InventarioInsumos || $upd_editar_InventarioInsumos || $upd_ver_InventarioInsumos || $upd_borrar_InventarioInsumos || $upd_exportar_InventarioInsumos){
            $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else{
            $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_InventarioSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_InventarioSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_InventarioSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_InventarioSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_InventarioSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_ACTIVO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_Inventarioactivos,
                            'sipa_permisos_roles_editar'=>$upd_editar_Inventarioactivos,
                            'sipa_permisos_roles_ver'=>$upd_ver_Inventarioactivos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_Inventarioactivos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_Inventarioactivos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_INSUMO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_InventarioInsumos,
                            'sipa_permisos_roles_editar'=>$upd_editar_InventarioInsumos,
                            'sipa_permisos_roles_ver'=>$upd_ver_InventarioInsumos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_InventarioInsumos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_InventarioInsumos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','MI_INV')->get()[0];
        if($upd_crear_MiInventarioactivos || $upd_editar_MiInventarioactivos || $upd_ver_MiInventarioactivos || $upd_borrar_MiInventarioactivos || $upd_exportar_MiInventarioactivos){
            $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }else{
            $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','MI_INV_ACTIVO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_MiInventarioactivos,
                            'sipa_permisos_roles_editar'=>$upd_editar_MiInventarioactivos,
                            'sipa_permisos_roles_ver'=>$upd_ver_MiInventarioactivos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_MiInventarioactivos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_MiInventarioactivos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

          $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO')->get()[0];
          if($upd_crear_HistorialSalas || $upd_editar_HistorialSalas || $upd_ver_HistorialSalas || $upd_borrar_HistorialSalas || $upd_exportar_HistorialSalas || 
          $upd_crear_Historialactivos || $upd_editar_Historialactivos || $upd_ver_Historialactivos || $upd_borrar_Historialactivos || $upd_exportar_Historialactivos){
            $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else{
            $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_HistorialSalas,
                            'sipa_permisos_roles_editar'=>$upd_editar_HistorialSalas,
                            'sipa_permisos_roles_ver'=>$upd_ver_HistorialSalas,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_HistorialSalas,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_HistorialSalas,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_ACTIVO')->get()[0];
        $permiso->update(['sipa_permisos_roles_crear'=>$upd_crear_Historialactivos,
                            'sipa_permisos_roles_editar'=>$upd_editar_Historialactivos,
                            'sipa_permisos_roles_ver'=>$upd_ver_Historialactivos,
                            'sipa_permisos_roles_borrar'=>$upd_borrar_Historialactivos,
                            'sipa_permisos_roles_exportar'=>$upd_exportar_Historialactivos,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);

        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG')->get()[0];
        if($upd_crear_ConfiguracionCorreos || $upd_editar_ConfiguracionCorreos || $upd_ver_ConfiguracionCorreos || $upd_borrar_ConfiguracionCorreos || $upd_exportar_ConfiguracionCorreos || 
        $upd_crear_ConfiguracionUsuarios || $upd_editar_ConfiguracionUsuarios || $upd_ver_ConfiguracionUsuarios || $upd_borrar_ConfiguracionUsuarios || $upd_exportar_ConfiguracionUsuarios ||
        $upd_crear_ConfiguracionTiposDeUsuario || $upd_editar_ConfiguracionTiposDeUsuario || $upd_ver_ConfiguracionTiposDeUsuario || $upd_borrar_ConfiguracionTiposDeUsuario || $upd_exportar_ConfiguracionTiposDeUsuario ||
        $upd_crear_ConfiguracionRoles || $upd_editar_ConfiguracionRoles || $upd_ver_ConfiguracionRoles || $upd_borrar_ConfiguracionRoles || $upd_exportar_ConfiguracionRoles){
          $permiso->update(['sipa_permisos_roles_crear'=>true,
                            'sipa_permisos_roles_editar'=>true,
                            'sipa_permisos_roles_ver'=>true,
                            'sipa_permisos_roles_borrar'=>true,
                            'sipa_permisos_roles_exportar'=>true,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          } else{
            $permiso->update(['sipa_permisos_roles_crear'=>false,
                            'sipa_permisos_roles_editar'=>false,
                            'sipa_permisos_roles_ver'=>false,
                            'sipa_permisos_roles_borrar'=>false,
                            'sipa_permisos_roles_exportar'=>false,
                            'sipa_permisos_roles_usuario_actualizacion'=>$upd_usuario->sipa_usuarios_id]);
          }

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
        //Borrar los permisos
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAR_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAR_ACTIVO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_USO_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_USO_ACTIVO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG_ACTIVO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU_ACTIVO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_ACTIVO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_INSUMO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_FORMULARIOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_SALA')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO_ACTIVO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_CORREOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_TIPO_USUARIOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_USUARIOS')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG_ROLES')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','RESERVAR')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','ENTREG')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','DEVOLU')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','INV_USO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','HISTO')->get()[0];
        $permiso->delete();
        $permiso = Permiso::where('sipa_permisos_roles_role',$upd_rol->sipa_roles_id)->where('sipa_permisos_roles_opcion_menu_codigo','CONFIG')->get()[0];
        $permiso->delete();
    }
  }
