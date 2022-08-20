<?php

namespace App\Models\Afiliacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Perfil;

class SocialMediaProfile extends Model
{
    use HasFactory;

    protected $table='redes_sociales_perfil';

    protected $fillable=[
        'facebook_profile',
        'twitter_profile',
        'instagram_profile',
        'url_personal',
    ];
    protected $attributes = [
        'status' => 'A',
    ];

    public function perfil()
    {
        return $this->hasOne(Perfil::class,'id_redes_sociales');
    }
    
}
