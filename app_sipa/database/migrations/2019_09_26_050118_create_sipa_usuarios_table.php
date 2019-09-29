<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSipaUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sipa_usuarios', function (Blueprint $table) {
            $table->bigIncrements('sipa_usuarios_id');
            $table->string('sipa_usuarios_identificacion');
            $table->string('sipa_usuarios_contrasenna');
            $table->string('sipa_usuarios_nombre');
            $table->string('sipa_usuarios_apellidos');
            $table->string('sipa_usuarios_telefono');
            $table->string('sipa_usuarios_correo')->unique();
            $table->integer('sipa_usuarios_unidad');
            $table->integer('sipa_usuarios_edificio');
            $table->integer('sipa_usuarios_rol');
            $table->integer('sipa_usuarios_usuario_creador');
            $table->integer('sipa_usuarios_usuario_actulizacion');
            $table->rememberToken();
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
        Schema::dropIfExists('sipa_usuarios');
    }
}
