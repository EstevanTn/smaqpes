<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro', function (Blueprint $table) {
            $table->increments('id_registro');
            $table->integer('id_cliente');
            $table->integer('id_maquinaria');
            $table->integer('id_tipo_registro');
            $table->string('lugar', 350)->nullable();
            $table->dateTime('fecha_emision');
            $table->time('hora_inicio_mantto')->nullable();
            $table->time('hora_termino_mantto')->nullable();
            $table->integer('id_horas')->nullable();
            $table->decimal('total_horas', 10,2);
            $table->time('hora_salida_viaje')->nullable();
            $table->time('hora_llegada_viaje')->nullable();
            $table->time('hora_salida_retorno')->nullable();
            $table->time('hora_llegada_retorno')->nullable();
            $table->decimal('horometro', 10, 4);
            $table->decimal('kilometraje', 10, 4);
            $table->char('estado_maquinaria', 1);
            $table->string('lugar_encontrado', 350)->nullable();
            $table->integer('id_operador');
            $table->integer('id_mecanico');
            $table->integer('id_jefe_responsable');
            $table->string('observacion', 500)->nullable();
            $table->char('estado', 1);
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente');
            $table->foreign('id_maquinaria')->references('id_maquinaria')->on('maquinaria');
            $table->foreign('id_tipo_registro')->references('id_tipo_registro')->on('tipo_registro');
            $table->foreign('id_horas')->references('id_horas_mantenimiento')->on('horas_mantenimiento');
            $table->foreign('id_operador')->references('id_personal')->on('personal');
            $table->foreign('id_mecanico')->references('id_personal')->on('personal');
            $table->foreign('id_jefe_responsable')->references('id_personal')->on('personal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro');
    }
}
