<?php

namespace App\Http\Controllers\Residente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController as MessageController;
use App\Http\Resources\RegistroVehiculoResidenteResource;
use App\Http\Resources\InformeResidentesResource;
use App\Models\VehiculosResidentes;
use App\Models\ListaVehiculos;
use App\Models\TipoVehiculos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VehiculoResidenteController extends MessageController
{

    //metodo para registrar la entrada/salida de vehiculo residente

    public function registerVehiculoResidente(Request $request)
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

        $entradaVehiculo = VehiculosResidentes::select()->where('id_lista_vehiculo', $placa->id)->first();

        $fecha = Carbon::now()->toDateTimeString();

        if(is_null($entradaVehiculo)) {

            $data = $request->all();
            $data['id_lista_vehiculo'] = $placa->id;
            $data['entrada'] = $fecha;
            $data['minutos'] = 0;

            $result = VehiculosResidentes::create($data);

            $data = new RegistroVehiculoResidenteResource($result);

            return $this->sendResponse($data, 'Entrada de vehiculo residente registrado exitosamente');

        }

        if(is_null($entradaVehiculo->entrada)) {

            $entradaVehiculo->entrada = $fecha;
            $entradaVehiculo->salida = null;

            $entradaVehiculo->save();

            $data = new RegistroVehiculoResidenteResource($entradaVehiculo);

            return $this->sendResponse($data, 'Entrada de vehiculo residente registrado exitosamente');

        }

        $minutos = $entradaVehiculo->minutos + (Carbon::parse($entradaVehiculo->entrada)->diffInMinutes(Carbon::parse($fecha)));

        $entradaVehiculo->entrada = null;
        $entradaVehiculo->salida = $fecha;
        $entradaVehiculo->minutos = $minutos;

        $entradaVehiculo->save();

        $data = new RegistroVehiculoResidenteResource($entradaVehiculo);

        return $this->sendResponse($data, 'Salida de vehiculo residente registrado exitosamente');

    }

    //metodo para generar el informe de vehiculos residentes

    public function informeVehiculoResidente()
    {

        $residentes = VehiculosResidentes::select(
            "vehiculos_residentes.id",
            "vehiculos_residentes.id_lista_vehiculo",
            "vehiculos_residentes.minutos",
            "lista_vehiculos.placa"
        )
        ->join("lista_vehiculos", "lista_vehiculos.id", "=", "vehiculos_residentes.id_lista_vehiculo")
        ->get();

        if ($residentes->isEmpty()) {

            return $this->sendError('Error', ['error' => 'No se encontraron datos'], 404);

        }

        $vehiculo = ListaVehiculos::select()->where('id', $residentes[0]->id_lista_vehiculo)->first();

        foreach ($residentes as $row) {

            $row['total'] = number_format($row->minutos * ((float)$vehiculo->getTipoVehiculo->costo), 2);

        }

        return $this->sendResponse($residentes, 'Lista residentes');

    }

    //metodo para resetear los minutos de los vehiculos de residentes

    public function resetMinutosResidentes()
    {

        $residentes = VehiculosResidentes::all();

        if ($residentes->isEmpty()) {

            return $this->sendError('Error', ['error' => 'No se encontraron datos'], 404);

        }

        foreach ($residentes as $row) {

            $row->minutos = 0.00;

            $row->save();

        }

        return $this->sendResponse($residentes, 'Lista residente reseteada exitosamente');

    }

}
