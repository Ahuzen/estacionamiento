<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListaVehiculos;

class VehiculosResidentes extends Model
{

    use HasFactory;

     /**
     * @var string $table
     */
    protected $table = 'vehiculos_residentes';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id_lista_vehiculo',
        'entrada',
        'salida',
        'minutos'
    ];


    public function getPlacaVehiculo()
    {
        return $this->belongsTo('App\Models\ListaVehiculos', 'id_lista_vehiculo', 'id')->select('id', 'placa', 'id_tipo_vehiculo');
    }

}
