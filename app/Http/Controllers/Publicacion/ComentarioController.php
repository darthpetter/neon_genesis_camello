<?php

namespace App\Http\Controllers\Publicacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Publicacion;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ComentarioController extends Controller
{
    public function get($publicacionID){
        $comentarios=Comentario::where('publicacionID',$publicacionID)->get();

        return response()->json([
            'comentarios' => $comentarios,
        ],200);
    }

    public function store($publicacionID,Request $request){
        $validator=$this->validator($request);

        if($validator->fails()){            
            return response()->json([
                'message'=>$validator->errors(),
            ],200);
        }

        $user=User::find(auth()->user()->id);
        $publicacion=Publicacion::find($publicacionID);

        $comentario=new Comentario($request->only('contenido','url_fileserver'));
        $comentario->user()->associate($user);
        $comentario->publicacion()->associate($publicacion)->save();

        return response()->json([
            'message'=>'Comentario guardado exitosamente',
        ],200);
    }
    
    public function update($publicacionID,$comentarioID,Request $request){
        $validator=$this->validator($request);

        if($validator->fails()){            
            return response()->json([
                'message'=>$validator->errors(),
            ],200);
        }

        Comentario::where('id',$comentarioID)->update($request->only('contenido','url_fileserver'));

        return response()->json([
            'message'=>'Comentario actualizado exitosamente',
        ],200);
    }

    public function delete($publicacionID,$comentarioID){
        $comentario=Comentario::where('id',$comentarioID)->delete();
        if($comentario==null){
            return response()->json([
                'message'=>'Nada que eliminar',
            ],404);
        }
        return response()->json([
            'message'=>'Comentario eliminado exitosamente',
        ],200);
    }

    protected function validator(Request $request){
        return Validator::make($request->all(),[
            'contenido' =>Rule::requiredIf($request->url_fileserver==null),
        ]);
    }
}
