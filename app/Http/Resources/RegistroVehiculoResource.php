<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class RegistroVehiculoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        //$tipo = $oficial->getTipoVehiculo->tipo;

        return [
            'id' => $this->id,
            'tipo' => $this->getTipoVehiculo->tipo,
            'placa' => $this->placa,
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y'),
            'updatedAt' => Carbon::parse($this->updated_at)->format('d-m-Y')
        ];

    }
}
