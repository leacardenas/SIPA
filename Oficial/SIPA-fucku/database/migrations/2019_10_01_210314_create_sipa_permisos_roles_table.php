<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipaPermisosRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sipa_permisos_roles', function (Blueprint $table) {
            $table->bigIncrements('sipa_permisos_roles_id');
            $table->integer('sipa_permisos_roles_role');
            $table->integer('sipa_permisos_roles_opciones_menu');
            $table->boolean('sipa_permisos_roles_crear');
            $table->boolean('sipa_permisos_roles_editar');
            $table->boolean('sipa_permisos_roles_ver');
            $table->boolean('sipa_permisos_roles_exportar');
            $table->integer('sipa_permisos_roles_usuario_creador');
            $table->integer('sipa_permisos_roles_usuario_actualizacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sipa_permisos_roles');
    }
}
