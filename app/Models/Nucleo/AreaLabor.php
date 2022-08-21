<?php

namespace App\Models\Nucleo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaLabor extends Model
{
    use HasFactory;
    protected $table='areas_labor';
    protected $fillable=[
        'nombre',
        'descripcion',
    ];

    protected $attributes = [
        'status' => 'A',
    ];
}
