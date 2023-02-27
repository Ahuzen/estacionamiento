<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoVehiculos;
use App\Models\VehiculosResidentes;

class ListaVehiculos extends Model
{

    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'lista_vehiculos';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'id_tipo_vehiculo',
        'placa'
    ];

    public function getTipoVehiculo()
    {
        return $this->belongsTo('App\Models\TipoVehiculos', 'id_tipo_vehiculo', 'id')->select('id', 'tipo', 'costo');
    }

}
