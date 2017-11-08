<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorasTrabajadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas_trabajadas', function (Blueprint $table) {
            $table->increments('id_horas_trabajadas');
            $table->integer('id_registro');
            $table->integer('id_personal');
            $table->decimal('horas', 6, 2);
            $table->string('descripcion', 1024);
            $table->dateTime('fecha');
            $table->time('hora_inicio');
            $table->time('hora_termino');
            $table->timestamps();
            $table->foreign('id_registro')->references('id_registro')->on('registro');
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
        Schema::dropIfExists('horas_trabajadas');
    }
}
