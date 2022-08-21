<?php

namespace App\Http\Controllers\Postulaciones;

use App\Http\Controllers\Controller;
use App\Models\Nucleo\AreaLabor;
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

        $areas_labor=AreaLabor::where('status','!=','E')->get();

        return view('cliente.postulaciones.index',compact('postulaciones','areas_labor'));
    }

    public function index(){

        $postulaciones=Postulacion::paginate(10);

        return response()->json([
            'postulaciones'=>$postulaciones,
            'status'=>200,
        ]);
    }

    public function getPostulacionById($id)
    {
        $postulacion=Postulacion::find($id);
        return view('cliente.postulaciones.detallePostulacion',compact('postulacion'));
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
            'id_area_labor' => $request['id_area_labor'],
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
            'id_area_labor' =>'required|exists:areas_labor,id',
        ]);
    }
    
    public function eliminarPostulacion(Request $request)
    {
        Log::info($request->all());

        $postulacion=Postulacion::where('id_postulacion',$request->id_postulacion);
        //$postulacion=Postulacion::find('id',$request->id_postulacion);
        
        //$postulacion->update(['estado'=>'E']);

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
