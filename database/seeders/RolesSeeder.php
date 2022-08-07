<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nucleo\Rol;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create(['name'=>'ADMINISTRADOR']);
        Rol::create(['name'=>'PROFESIONISTA']);
        Rol::create(['name'=>'CLIENTE']);
    }
}
