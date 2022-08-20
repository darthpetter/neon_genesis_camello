<?php

namespace App\Models\Publicacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Publicacion\Publicacion;

class Reaccion extends Model
{
    use HasFactory;
    protected $table='reacciones';
    protected $attributes = [
        'status' => 'A',
    ];
    public function user(){
        return $this->belongsTo(User::class,'id_usuario');
    }
    public function publicacion(){
        return $this->belongsTo(Publicacion::class,'id_publicacion');
    }
}
