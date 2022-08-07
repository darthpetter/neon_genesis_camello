<?php

namespace App\Models\Publicacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Publicacion extends Model
{
    use HasFactory;
    protected $table='tbm_publicaciones';

    protected $fillable=['contenido'];

    protected $attributes = [
        'status' => 'A',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_usuario');
    }
}
