<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleHorasMantenimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_horas_mantenimiento', function (Blueprint $table) {
            $table->increments('id_detalle_horas_mantenimiento');
            $table->integer('id_horas_mantenimiento');
            $table->integer('id_material');
            $table->string('tipo_material', 20);
            $table->string('descripcion', 250);
            $table->decimal('cantidad', 6, 2)->nullable();
            $table->decimal('litros', 6, 2)->nullable();
            $table->decimal('galones', 6, 2)->nullable();
            $table->boolean('estado');
            $table->timestamps();
            $table->foreign('id_material')->references('id_material')->on('material');
            $table->foreign('id_horas_mantenimiento')->references('id_horas_mantenimiento')->on('horas_mantenimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_horas_mantenimiento');
    }
}
