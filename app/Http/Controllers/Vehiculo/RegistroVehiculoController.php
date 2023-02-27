<?php

namespace App\Http\Controllers\Vehiculo;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController as MessageController;
use App\Http\Resources\RegistroVehiculoResource;
use App\Models\ListaVehiculos;
use Illuminate\Http\Request;

class RegistroVehiculoController extends MessageController
{

    //metodo para registrar un nuevo vehiculo oficial/residente

    public function register(Request $request)
    {

        $reglas = [
            'id_tipo_vehiculo' => 'required',
            'placa' => 'required|min:4|max:10|unique:lista_vehiculos'
        ];

        $this->validate($request, $reglas);

        $oficial = ListaVehiculos::create($request->all());

        $data = new RegistroVehiculoResource($oficial);

        return $this->sendResponse($data, 'Vehiculo ingresado exitosamente');

    }


}
