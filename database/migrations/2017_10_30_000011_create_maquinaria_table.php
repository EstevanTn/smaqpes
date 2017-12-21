<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinaria', function (Blueprint $table) {
            $table->increments('id_maquinaria');
            $table->integer('id_tipo_maquinaria')->unsigned();
            $table->string('nombre', 200);
            $table->integer('anio_fabricacion');
            $table->string('marca', 50);
            $table->string('modelo', 20);
            $table->string('serie_chasis', 20);
            $table->string('serie_motor', 20);
            $table->date('fecha_adquisicion');
            $table->string('imagen', 300)->nullable();
            $table->boolean('estado')->default(true);
            $table->boolean('eliminado');
            $table->timestamps();
            $table->foreign('id_tipo_maquinaria')
                ->references('id_tipo_maquinaria')
                ->on('tipo_maquinaria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maquinaria');
    }
}
