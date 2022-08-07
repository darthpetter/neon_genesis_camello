<?php

namespace App\Http\Controllers\Nucleo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nucleo\TipoIdentificacion;

class TiposIdentificacionController extends Controller
{
    public function getListTiposIdentificacion(){
        $listado=TipoIdentificacion::all();
        return response()->json([
            'tipos_identificacion'  => $listado,
            'estatus'=>200,
        ]);
    }
}
