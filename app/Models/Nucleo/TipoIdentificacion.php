<?php

namespace App\Models\Nucleo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    use HasFactory;

    protected $table='tipos_identificacion';

    protected $fillable=[
        'descripcion',
        'max_caracteres',
        'alfanumerico',
    ];
}
