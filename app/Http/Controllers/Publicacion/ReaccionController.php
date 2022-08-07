<?php

namespace App\Http\Controllers\Publicacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reaccion;
use App\Models\User;
use App\Models\Publicacion;

class ReaccionController extends Controller
{
    public function store($publicacionID){

        $perfil=User::find(auth()->user()->id);
        $publicacion=Publicacion::find($publicacionID);

        $reaccion = new Reaccion();
        $reaccion->user()->associate($perfil);
        $reaccion->publicacion()->associate($publicacion)->save();


        return response()->json([
            'message'=>'Like dao',
        ],500);
    }
    public function destroy($publicacionID){
        Reaccion::where('publicacionID',$publicacionID)->delete();

        return response()->json([
            'message'=>'Like quitao',
        ],500);
    }
}
