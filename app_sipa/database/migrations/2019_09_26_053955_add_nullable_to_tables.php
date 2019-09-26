<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sipa_opciones_menus', function (Blueprint $table) {
            $table->integer('sipa_opciones_menu_usuario_actualizacion')->nullable()->change();
        });

        Schema::table('sipa_roles', function (Blueprint $table) {
            $table->integer('sipa_roles_usuario_actualizacion')->nullable()->change();
        });

        Schema::table('sipa_permisos_roles', function (Blueprint $table) {
            $table->integer('sipa_permisos_roles_usuario_actualizacion')->nullable()->change();
        });

        Schema::table('sipa_usuarios', function (Blueprint $table) {
            $table->integer('sipa_usuarios_unidad')->nullable()->change();
            $table->integer('sipa_usuarios_edificio')->nullable()->change();
            $table->integer('sipa_usuarios_rol')->nullable()->change();
            $table->integer('sipa_usuarios_usuario_actulizacion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            //
        });
    }
}
