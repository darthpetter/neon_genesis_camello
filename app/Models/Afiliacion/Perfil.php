<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Afiliacion\SocialMediaProfile;

class Perfil extends Model
{
    use HasFactory;
    protected $table='tbm_perfiles';

    protected $fillable=[
        'id_tipo_identificacion',
        'identificacion',
        'nombres',
        'apellidos',
        'bio',
        'fecha_nacimiento',
        'escolaridad',
        'direccion_domicilio',
        'direccion_trabajo',
        'telefono1',
        'telefono2',
        'celular1',
        'celular2',
        'id_sexo'
    ];
    protected $attributes = [
        'status' => 'A',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class,'id_usuario');
    }
    public function socialmedia()
    {
        return $this->belongsTo(SocialMediaProfile::class,'id_redes_sociales');
    }
}
