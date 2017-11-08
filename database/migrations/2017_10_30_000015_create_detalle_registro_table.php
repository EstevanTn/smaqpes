<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleRegistroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_registro', function (Blueprint $table) {
            $table->increments('id_detalle_registro');
            $table->integer('id_registro');
            $table->integer('id_material');
            $table->string('tipo_material', 20);
            $table->string('descripcion', 250);
            $table->decimal('cantidad', 6, 2);
            $table->decimal('litros', 6, 2);
            $table->decimal('galones', 6, 2);
            $table->boolean('estado')->default(true);
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            $table->foreign('id_registro')->references('id_registro')->on('registro');
            $table->foreign('id_material')->references('id_material')->on('material');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_registro');
    }
}
