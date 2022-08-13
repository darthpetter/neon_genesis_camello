<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Afiliacion\Perfil;
use App\Models\Nucleo\TipoIdentificacion;
use App\Models\Nucleo\Sexo;
use App\Controlles\SocialMediaController;

use Illuminate\Support\Facades\Log;

class PerfilController extends Controller
{

    public function index(){
        $tipos_id=TipoIdentificacion::all();
        $sexos=Sexo::all();
        $perfil=Perfil::where('id_usuario',auth()->user()->id)->first();




        return view('perfil_rrss.index',compact('tipos_id','sexos','perfil'));
    }

    public function store(Request $request)
    {
        $perfil=Perfil::where('id_usuario',auth()->user()->id)->first();

        $regla_identificacion='';
        if($request->id_tipo_identificacion!==0 && $request->id_tipo_identificacion!==NULL){
            $tipo_identificacion=TipoIdentificacion::where('id',$request->id_tipo_identificacion)->first();
            if($tipo_identificacion->alfanumerico){
                $regla_identificacion='alpha_num|size:'.$tipo_identificacion['max_caracteres'].'';
            }else{
                $regla_identificacion='digits:'.$tipo_identificacion['max_caracteres'].'';
            }
        }
        

        $request->validate([
            'id_tipo_identificacion'=>'required|exists:tbr_tipos_identificacion,id',
            'identificacion'=>[$regla_identificacion,Rule::unique('tbm_perfiles')->ignore($perfil->identificacion,'identificacion')],
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'bio'=>'required|max:255',
            'escolaridad'=>'nullable|max:50',
            'direccion_domicilio'=>'nullable|max:255',
            'direccion_trabajo'=>'nullable|max:255',
            'telefono1'=>'nullable|max:9',
            'telefono2'=>'nullable|max:9',
            'celular1'=>'nullable|max:10',
            'celular2'=>'nullable|max:10',
            'id_sexo'=>'nullable|exists:tbr_sexos,id',
        ]);
    

        $perfil->update($request->only(
            'id_tipo_identificacion','identificacion','fecha_nacimiento',
            'nombres','apellidos','bio','escolaridad','id_sexo',
            'direccion_domicilio','direccion_trabajo',
            'telefono1','telefono2','celular1','celular2'
        ));
        
        return redirect()->route('dashboard');
    }

    public function getPerfil()
    {
        $perfil=Perfil::where('id_usuario',auth()->user()->id)->first();
        return view('perfil_mostrar.perfil',compact('perfil'));
    }
    
    public function getInfo(){
        $perfil=Perfil::find(auth()->user()->id);
        return response()->json([
            'status'=>200,
            'perfil'=>$perfil,
        ],200);
    }

    protected function validation(Request $request,$identificacion){
        $regla_identificacion='';
        if($request->id_tipo_identificacion!==0 && $request->id_tipo_identificacion!==NULL){
            $tipo_identificacion=TipoIdentificacion::where('id',$request->id_tipo_identificacion)->first();
            if($tipo_identificacion->alfanumerico){
                $regla_identificacion='alpha_num|size:'.$tipo_identificacion['max_caracteres'].'';
            }else{
                $regla_identificacion='digits:'.$tipo_identificacion['max_caracteres'].'';
            }
        }
        

        return Validator::make($request->all(),[
            'id_tipo_identificacion'=>'required|exists:tbr_tipos_identificacion,id',
            'identificacion'=>[
                $regla_identificacion,
                Rule::unique('tbm_perfiles')->ignore($identificacion,'identificacion'),
            ],
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'bio'=>'required|max:255',
            'escolaridad'=>'nullable|max:50',
            'direccion_domicilio'=>'nullable|max:255',
            'direccion_trabajo'=>'nullable|max:255',
            'telefono1'=>'nullable|max:9',
            'telefono2'=>'nullable|max:9',
            'celular1'=>'nullable|max:10',
            'celular2'=>'nullable|max:10',
            'id_sexo'=>'nullable|exists:tbr_sexos,id',
        ]);
    }

}
