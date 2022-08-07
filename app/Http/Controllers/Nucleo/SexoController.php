<?php

namespace App\Http\Controllers\Nucleo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nucleo\Sexo;

class SexoController extends Controller
{
    public function getListSexos(){
        $sexos=Sexo::all();
        return $sexos;
    }
}
