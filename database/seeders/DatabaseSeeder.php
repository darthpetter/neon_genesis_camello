<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\SexosSeeder;
use Database\Seeders\FormasPagoSeeder;
use Database\Seeders\TipoidentificacionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            SexosSeeder::class,
            //FormasPagoSeeder::class,
            TipoidentificacionSeeder::class, 
        ]);
    }
}
