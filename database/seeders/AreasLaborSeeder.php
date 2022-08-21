<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nucleo\AreaLabor;

class AreasLaborSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreaLabor::create(['nombre'=>'Albañilería','id_usuario_creador'=>1]);
        AreaLabor::create(['nombre'=>'Carpintería','id_usuario_creador'=>1]);
        AreaLabor::create(['nombre'=>'Laqueado','id_usuario_creador'=>1]);
        AreaLabor::create(['nombre'=>'Pintura','id_usuario_creador'=>1]);
    }
}
