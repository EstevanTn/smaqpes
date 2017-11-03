<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->increments('id_material');
            $table->integer('id_tipo_material');
            $table->string('nombre',70);
            $table->string('descripcion', 250)->nullable();
            $table->string('codigo_proveedor', 20)->nullable();
            $table->string('codigo_interno', 20)->nullable();
            $table->char('estado', 1);
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            $table->foreign('id_tipo_material')->references('id_tipo_material')->on('tipo_material');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material');
    }
}
