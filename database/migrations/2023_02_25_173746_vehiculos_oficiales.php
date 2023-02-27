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

        Schema::dropIfExists('vehiculos_oficiales');

        Schema::create('vehiculos_oficiales', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_lista_vehiculo')->unsigned();
            $table->string('entrada', 10)->nullable();
            $table->string('salida', 10)->nullable();
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
        Schema::dropIfExists('vehiculos_oficiales');
    }
};
