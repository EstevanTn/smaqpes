<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->increments('id_area');
            $table->integer('id_area_padre')->unsigned()->nullable();
            $table->string('nombre', 50);
            $table->string('descripcion', 250)->nullable();
            $table->boolean('estado');
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
            $table->foreign('id_area_padre')->references('id_area')->on('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area');
    }
}
