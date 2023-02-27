<?php

namespace App\Http\Controllers\Oficial;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController as MessageController;
use App\Models\VehiculosOficiales;
use App\Models\ListaVehiculos;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Resources\RegistroVehiculoOficialResource;

class VehiculoOficialController extends MessageController
{

    //metodo para registrar entrada/salida de vehiculos oficiales

    public function registerVehiculoOficial(Request $request)
    {

        $reglas = [
            'placa' => 'required'
        ];

        $this->validate($request, $reglas);

        $placa = ListaVehiculos::select('id', 'placa')->where('placa', $request->placa)->first();

        if(is_null($placa)) {

            return $this->sendError('Error', ['error' => 'Placa ingresada incorrecta'], 400);
            return abort(400);

        }

        $data = $request->all();

        $salidaVehiculo = VehiculosOficiales::select()->where('id_lista_vehiculo', $placa->id)->latest()->first();

        $hora = Carbon::now()->format('g:i A');

        if(!is_null($salidaVehiculo) && is_null($salidaVehiculo->salida)) {

            $salidaVehiculo->salida = $hora;

            $salidaVehiculo->save();

            $data = new RegistroVehiculoOficialResource($salidaVehiculo);

            return $this->sendResponse($data, 'Salida de vehiculo oficial registrado exitosamente');

        }

        $data['id_lista_vehiculo'] = $placa->id;
        $data['entrada'] = $hora;

        $result = VehiculosOficiales::create($data);

        $data = new RegistroVehiculoOficialResource($result);

        return $this->sendResponse($data, 'Entrada de vehiculo oficial registrado exitosamente');

    }

    //metodo para eliminar las estancias de vehiculos oficiales

    public function eliminarEstanciasVehiculo()
    {

        $data = VehiculosOficiales::truncate();

        return $this->sendResponse($data, 'Estancias de vehiculos eliminadas exitosamente');

    }

}
