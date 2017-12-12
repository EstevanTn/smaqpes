<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorasTrabajadasMaquinariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas_trabajadas_maquinaria', function (Blueprint $table) {
            $table->increments('id_horas_trabajadas_maquinaria');
            $table->integer('id_personal')->unsigned()->first()->nullable();
            $table->dateTime('fecha_trabajo');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_termino')->nullable();
            $table->decimal('horometro', 8, 4);
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
        Schema::dropIfExists('horas_trabajadas_maquinaria');
    }
}
