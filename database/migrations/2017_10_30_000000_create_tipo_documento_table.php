<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoDocumentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_documento', function (Blueprint $table) {
            $table->increments('id_tipo_documento');
            $table->string('nombre', 80);
            $table->char('siglas', 5);
            $table->string('descripcion', 150)->nullable();
            $table->string('valor', 10);
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
        Schema::dropIfExists('tipo_documento');
    }
}
