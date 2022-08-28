<?php

namespace App\Models\Postulaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionPostulacion extends Model
{
    use HasFactory;
    protected $table='asignacion_postulaciones';

    protected $fillable=[
        'id_postulacion',
        'monto_propuesto',
        'comentario',
        'id_usuario_creador',
    ];

    protected $attributes=[
        'estado'=>'A',
    ];
}
