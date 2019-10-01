<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sipa_usuarios_identificacion')->nullable();
            $table->string('name');
            $table->string('sipa_usuarios_apellidos')->nullable();
            $table->string('sipa_usuarios_telefono')->nullable();
            $table->string('email')->unique();
            $table->integer('sipa_usuarios_unidad')->nullable();
            $table->integer('sipa_usuarios_edificio')->nullable();
            $table->integer('sipa_usuarios_rol')->nullable();
            $table->integer('sipa_usuarios_usuario_creador')->nullable();
            $table->integer('sipa_usuarios_usuario_actulizacion')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
