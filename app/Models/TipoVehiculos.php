<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListaVehiculos;

class TipoVehiculos extends Model
{

    use HasFactory;

    /**
     * @var string $table
     */
    protected $table = 'tipo_vehiculos';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'tipo',
        'costo'
    ];

}
