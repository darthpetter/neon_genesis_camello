<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nucleo\TipoIdentificacion;

class TipoidentificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoIdentificacion::create([
            'descripcion'=>'CEDULA DE IDENTIDAD - ECUATORIANA',
            'max_caracteres'=>10,
            'alfanumerico'=>false
        ]);
        TipoIdentificacion::create([
            'descripcion'=>'REGISTRO UNICO DE CONSTRIBUYENTES',
            'max_caracteres'=>13,
            'alfanumerico'=>false
        ]);
    }
}
