<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSipaRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sipa_roles', function (Blueprint $table) {
            $table->bigIncrements('sipa_roles_id');
            $table->string('sipa_roles_codigo');
            $table->string('sipa_roles_nombre');
            $table->mediumtext('sipa_roles_descripcion');
            $table->integer('sipa_roles_usuario_creador');
            $table->integer('sipa_roles_usuario_actualizacion');
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
        Schema::dropIfExists('sipa_roles');
    }
}
