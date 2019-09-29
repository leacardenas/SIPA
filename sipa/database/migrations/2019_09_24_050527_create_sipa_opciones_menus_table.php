<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSipaOpcionesMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sipa_opciones_menus', function (Blueprint $table) {
            $table->bigIncrements('sipa_opciones_menu_id');
            $table->string('sipa_opciones_menu_codigo');
            $table->string('sipa_opciones_menu_nombre');
            $table->mediumtext('sipa_opciones_menu_descripcion');
            $table->integer('sipa_opciones_menu_usuario_creador');
            $table->integer('sipa_opciones_menu_usuario_actualizacion');
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
        Schema::dropIfExists('sipa_opciones_menus');
    }
}
