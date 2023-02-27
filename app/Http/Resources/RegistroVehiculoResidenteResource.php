<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class RegistroVehiculoResidenteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'idVehiculo' => $this->id,
            'placa' => $this->getPlacaVehiculo->placa,
            'entrada' => $this->entrada,
            'salida' => $this->salida,
            'minutos' => $this->minutos,
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'updatedAt' => Carbon::parse($this->updated_at)->format('d-m-Y')
        ];

    }
}
