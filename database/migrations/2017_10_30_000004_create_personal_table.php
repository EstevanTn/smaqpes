<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('id_personal');
            $table->integer('id_persona')->unsigned();
            $table->integer('id_area')->unsigned();
            $table->string('cargo', 100);
            $table->date('fecha_contrato')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->decimal('sueldo_base', 10, 4);
            $table->boolean('eliminado')->default(false);
            $table->char('estado',1)->default('A');
            $table->timestamps();
            //Schema::disableForeignKeyConstraints();
            $table->foreign('id_persona')->references('id_persona')->on('persona');
            $table->foreign('id_area')->references('id_area')->on('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal');
    }
}
