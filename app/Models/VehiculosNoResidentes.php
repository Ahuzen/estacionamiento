<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiculosNoResidentes extends Model
{

    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'vehiculos_no_residentes';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id_tipo_vehiculo',
        'placa',
        'entrada',
        'salida',
        'importe'
    ];

    public function getTipoVehiculo()
    {
        return $this->belongsTo('App\Models\TipoVehiculos', 'id_tipo_vehiculo', 'id')->select('id', 'tipo', 'costo');
    }

}
