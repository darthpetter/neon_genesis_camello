<?php

namespace App\Models\Nucleo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;
    protected $table='formas_pago';
    protected $fillable=[
        'descripcion',
        'id_usuario_creador'
    ];

    protected $attributes = [
        'status' => 'A',
    ];
}
