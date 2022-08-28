<?php

namespace App\Http\Controllers\Postulaciones;

use App\Http\Controllers\Controller;
use App\Models\Nucleo\AreaLabor;
use Illuminate\Http\Request;
use App\Models\Postulaciones\Postulacion;
use App\Models\Postulaciones\AsignacionPostulacion;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PostulacionController extends Controller
{
    public function index()
    {
        if(auth()->user()->id_rol==2){
            return $this->getFeedPostulaciones();
        }elseif(auth()->user()->id_rol==3){
            return $this->getByUserCreator();
        }
    }
    public function getByUserCreator()
    {
        $postulaciones=Postulacion::where('postulaciones.id_usuario_creador',auth()->user()->id)
        ->where('postulaciones.estado','!=','E')->join('areas_labor','postulaciones.id_area_labor','=','areas_labor.id')
        ->select('postulaciones.*','areas_labor.nombre as area_labor_descrip')
        ->get();

        $areas_labor=AreaLabor::where('status','!=','E')->get();
        return view('cliente.postulaciones.index',compact('postulaciones','areas_labor'));
    }

    public function getFeedPostulaciones(){

        $postulaciones=Postulacion::where('postulaciones.estado','!=','E')
        ->join('areas_labor','postulaciones.id_area_labor','=','areas_labor.id')
        ->select('postulaciones.*','areas_labor.nombre as area_labor_descrip')
        ->paginate(10);

        return view('profesionista.postulaciones.index',compact('postulaciones'));
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
        return Validator::make($request,[
            'titulo'=>'required',
            'descripcion' =>'required',
            'id_area_labor' =>'required|exists:areas_labor,id',
        ]);
    }
    
    public function eliminarPostulacion(Request $request)
    {
        try{
            
            $requestContent=json_decode($request->getContent());
            $postulacion=Postulacion::findOrFail($requestContent->id_postulacion);
            $postulacion->estado='E';
            $postulacion->update();
    
            return response()->json([
                'status'=>200,
                'postulacion'=>$postulacion,
            ]);
        }catch(\Exception $e){
            Log::alert('PostulacionController -> eliminarPostulacion : '.$e->getMessage());
            return response()->json([
                'status'=>400,
                'message'=> 'Algo salió mal. No se pudó efecturar la eliminación',
            ]);
        }

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

    public function detallePostulacionProf($id)
    {
        $postulacion=Postulacion::find($id);
        $asignacion=AsignacionPostulacion::where('id_usuario_creador',auth()->user()->id)
        ->where('estado','A')->where('id_postulacion',$id)->get();
        $asignaciones=AsignacionPostulacion::select('asignacion_postulaciones.*','perfiles.nombres','perfiles.apellidos')
        ->where('asignacion_postulaciones.estado','A')
        ->where('asignacion_postulaciones.id_postulacion',$id)
        ->join('users','users.id','=','asignacion_postulaciones.id_usuario_creador')
        ->join('perfiles','perfiles.id_usuario','=','users.id')->get();

        return view('profesionista.postulaciones.detalle',compact('postulacion','asignacion','asignaciones'));
    }

    public function postularse(Request $request)
    {
        try{
            $request->validate([
                'id_postulacion' => 'required|exists:postulaciones,id',
                'monto_propuesto'=>'required|numeric',
                'comentario'=>'required',
            ]);

            AsignacionPostulacion::create([
                'id_postulacion' => $request->id_postulacion,
                'monto_propuesto' => $request->monto_propuesto,
                'comentario' => $request->comentario,
                'id_usuario_creador' => auth()->user()->id,
            ]);

            return redirect()->route('postulaciones');
        }catch(\Exception $e){
            Log::error("ARCHIVO: ".__FILE__." LINEA: ".__LINE__."\n ERROR: ".$e->getMessage());
            return response()->json([
                'code'   => 'ERROR',
                'mensaje' => $e->getMessage(),
            ]);
        }
    }


}
