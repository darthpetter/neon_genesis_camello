<?php

namespace App\Http\Controllers\Postulaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postulaciones\Postulacion;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

class PostulacionController extends Controller
{
    public function getByUserCreator(Request $request)
    {
        $postulaciones=Postulacion::where('id_usuario_creador',auth()->user()->id)
        ->where('estado','!=','E')->get();

        return view('cliente.postulaciones.index',compact('postulaciones'));
    }

    public function index(){

        $postulaciones=Postulacion::paginate(10);

        return response()->json([
            'postulaciones'=>$postulaciones,
            'status'=>200,
        ]);
    }
    
    public function store(Request $request)
    {
        $request=json_decode($request->getContent(),true);
        $validator=$this->validation($request);
        if($validator->fails()){
            return response()->json([
                'status'=>401,
                'error'=>$validator->errors(),
            ]);
        }

        Postulacion::create([
            'titulo'=>$request['titulo'],
            'descripcion'=>$request['descripcion'],
            'id_usuario_creador'=>auth()->user()->id,
        ]);

        return response()->json([
            'status'=>200,
            'message'=>'Postulación registrada correctamente',
        ]);
    }

    protected function validation($request)
    {
        Log::info($request);
        return Validator::make($request,[
            'titulo'=>'required',
            'descripcion' =>'required',
        ]);
    }
    
    public function eliminarPostulacion($id)
    {
        $postulacion=Postulacion::where('id',$id)
        ->where('id_usuario_creador',auth()->user()->id)
        ->update(['estado'=>'E']);

        return response()->json([
            'status'=>200,
            'postulacion'=>$postulacion,
        ]);
    }

    public function cerrarPostulacion($id){
        Log::info("postulacion id: ".$id);
        $postulacion=Postulacion::where('id',$id)
        ->where('id_usuario_creador',auth()->user()->id)
        ->update(['estado'=>'C']);

        return response()->json([
            'status'=>200,
            'postulacion'=>$postulacion,
        ]);
    }
    
    public function updatePostulacion(Request $request, $id)
    {
        Log::info(var_export($request,true));
        $validator=$this->validation($request);
        if($validator->fails()){
            return response()->json([
                'status'=>401,
                'errores'=>$validator->errors(),
            ]);
        }

        $postulacion=Postulacion::where($id)
        ->update($request->only('titulo','descripcion'));

        return response()->json([
            'status'=>200,
            'postulacion'=>$postulacion,
        ]);
    }
}
