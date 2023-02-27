<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vehiculos_residentes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_lista_vehiculo')->unsigned();
            $table->timestamp('entrada')->nullable();
            $table->timestamp('salida')->nullable();
            $table->integer('minutos');
            $table->timestamps();

            $table->foreign('id_lista_vehiculo')->references('id')->on('lista_vehiculos');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos_residentes');
    }
};
