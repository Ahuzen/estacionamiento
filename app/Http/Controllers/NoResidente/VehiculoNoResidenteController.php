<?php

namespace App\Http\Controllers\NoResidente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController as MessageController;
use App\Http\Resources\RegistroVehiculoNoResidenteResource;
use App\Models\VehiculosNoResidentes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VehiculoNoResidenteController extends MessageController
{

    //metodo para registrar entrada/salida de vehiculos no residentes

    public function registerVehiculoNoResidente(Request $request)
    {
        $reglas = [
            'id_tipo_vehiculo' => 'required',
            'placa' => 'required'
        ];

        $this->validate($request, $reglas);

        $vehiculo = VehiculosNoResidentes::select()->where('placa', $request->placa)->latest()->first();

        $fecha = Carbon::now()->toDateTimeString();

        if(is_null($vehiculo) || (!is_null($vehiculo->entrada) && !is_null($vehiculo->salida))) {

            $data = $request->all();
            $data['entrada'] = $fecha;
            $data['importe'] = 0.00;

            $result = VehiculosNoResidentes::create($data);

            $data = new RegistroVehiculoNoResidenteResource($result);

            return $this->sendResponse($data, 'Entrada de vehiculo no residente registrado exitosamente');

        }

        if(is_null($vehiculo->salida)) {

            $importe = Carbon::parse($vehiculo->entrada)->diffInMinutes(Carbon::parse($fecha)) * $vehiculo->getTipoVehiculo->costo;

            $vehiculo->salida = $fecha;
            $vehiculo->importe = $importe;

            $vehiculo->save();

            $data = new RegistroVehiculoNoResidenteResource($vehiculo);

            return $this->sendResponse($data, 'Salida de vehiculo no residente registrado exitosamente');

        }

        return $this->sendError('Error', ['error' => 'Error al registrar entrada/salida de vehiculo no residente'], 406);

    }

}
