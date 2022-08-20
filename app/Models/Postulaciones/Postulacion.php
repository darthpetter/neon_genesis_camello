<?php

namespace App\Models\Postulaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;
    protected $table='postulaciones';

    protected $fillable=[
        'titulo',
        'descripcion',
        'id_usuario_creador',
    ];

    protected $attributes=[
        'estado' => 'A',
    ];
}
