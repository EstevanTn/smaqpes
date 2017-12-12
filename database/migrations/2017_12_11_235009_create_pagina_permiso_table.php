<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaginaPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagina_permiso', function (Blueprint $table) {
            $table->increments('id_pagina_permiso');
            $table->integer('id_pagina_permiso_padre')->unsigned()->nullable();
            $table->integer('id_rol');
            $table->string('icono', 50);
            $table->string('text', 50);
            $table->string('url', 200)->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
            $table->foreign('id_pagina_permiso_padre')->references('id_pagina_permiso')->on('pagina_permiso');
            $table->foreign('id_rol')->references('id_rol')->on('rol');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagina_permiso');
    }
}
