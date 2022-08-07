<?php

namespace App\Http\Controllers\Nucleo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nucleo\Rol;

class RolController extends Controller
{
    public function getRolesLibres(){
        $roles=Rol::where('id','!=',1)->get();
        return response()->json([
            'roles'=>$roles,
        ],200);
    }
}
