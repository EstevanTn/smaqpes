<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->increments('id_persona');
            $table->integer('id_tipo_documento')->unsigned();
            $table->string('numero_documento', 20);
            $table->string('nombres', 70);
            $table->string('apellidos', 100);
            $table->string('direccion', 150)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamps();
            //Schema::disableForeignKeyConstraints();
            $table->foreign('id_tipo_documento')->references('id_tipo_documento')->on('tipo_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
