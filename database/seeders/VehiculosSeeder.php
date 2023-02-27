<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoVehiculos;

class VehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TipoVehiculos::create(['tipo' => 'Oficial', 'costo' => 0.00]);
        TipoVehiculos::create(['tipo' => 'Residente', 'costo' => 0.05]);
        TipoVehiculos::create(['tipo' => 'No residente', 'costo' => 0.5]);

    }
}
