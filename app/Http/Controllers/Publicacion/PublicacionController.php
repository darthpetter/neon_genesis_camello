<?php

namespace App\Http\Controllers\Publicacion;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Publicacion\Publicacion;
use App\Models\User;

class PublicacionController extends Controller
{
    public function store(Request $request){

        $validator = $this->validation($request);
        if($validator->fails()){
            return response()->json([
                'errorList'=>$validator->errors(),
            ],401);
        }
        
        $publicacion=new Publicacion([
            'contenido'=>$request->contenido
        ]);
        $perfil=User::find(auth()->user()->id);

        $publicacion->user()->associate($perfil)->save();
        

        return response()->json([
            'message'=>'Publicacion guardada exitosamente',
        ],200);
    }
    protected function validation(Request $request){
        return Validator::make($request->all(),[
            'contenido'=>'required',
        ]);
    }
    public function index(){
        $publicaciones=Publicacion::where('id_usuario',auth()->user()->id)->get();

        return response()->json([
            'publicaciones' => $publicaciones,
        ],200);
    }
    public function update($id,Request $request){
        Log::info($request);
        $validator = $this->validation($request);
        if($validator->fails()){
            return response()->json([
                'errorList'=>$validator->errors(),
            ],401);
        }
        
        Publicacion::where('id',$id)->update($request->only('contenido'));

        return response()->json([
            'message'=>'Publicacion actualizada exitosamente',
        ],200);
    }
    public function delete($id){
        $publicacion=Publicacion::where('id',$id)->delete();

        if($publicacion==null){
            return response()->json([
                'message'=>'Nada para eliminar:(',
            ],404);
        }else{
            return response()->json([
                'message'=>'Publicacion eliminada exitosamente',
            ],500);
        }

    }
}
