<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('id_rol')->unsigned()->nullable();
            $table->integer('id_personal')->unsigned()->nullable();
            $table->enum('estado', ['ACTIVO','INACTIVO','BLOQUEADO'])->default('INACTIVO');
            $table->boolean('eliminado')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('id_rol')->references('id_rol')->on('rol');
            $table->foreign('id_personal')->references('id_personal')->on('personal');
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
