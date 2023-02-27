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
        Schema::dropIfExists('vehiculos_no_residentes');

        Schema::create('vehiculos_no_residentes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('id_tipo_vehiculo')->unsigned();
            $table->string('placa', 10);
            $table->timestamp('entrada')->nullable();
            $table->timestamp('salida')->nullable();
            $table->decimal('importe', 8, 2);
            $table->timestamps();

            $table->foreign('id_tipo_vehiculo')->references('id')->on('tipo_vehiculos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos_no_residentes');
    }
};
