<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class utpOfflineDevice extends Model
{
    use HasFactory;

    //protected $table = "dbo.utp_offline_devices";
    public $timestamps = false;

    protected $fillable = [
        'Equipo',
        'TipoEquipo',
        'SistemaOperativo',
        'Marca',
        'Modelo',
        'Inventario',
        'Serie',
        'Unidad',
        'Obsolescencia',
        'Procesador',
        'Generacion',
        'Memoria',
        'Discos',
        'Usuario',
        'Provincia',
        'Zona',
        'TipoAmbiente',
        'NombreAmbiente',
        'Pabellon',
        'DireccionSede',
        'NroPiso',
        'Propietario',
        'Estado',
        'Anexo',
        'Responsable',
        'FechaRobo',
        'FechaInicioLeasing',
        'FechaFinLeasing',
    ];
}
