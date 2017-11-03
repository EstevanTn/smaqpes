<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->integer('id_persona');
            $table->string('ruc', 11);
            $table->string('razon_social', 150);
            $table->string('nombre_comercial', 150)->nullable();
            $table->string('direccion_cliente', 250)->nullable();
            $table->char('estado', 1)->default('A');
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            Schema::disableForeignKeyConstraints();
            $table->foreign('id_persona')->references('id_persona')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
