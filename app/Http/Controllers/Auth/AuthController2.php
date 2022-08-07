<?php

namespace App\Http\Controllers\UsersControllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion.manejaUsuarios.registrarUsuarios');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email' => 'required|unique:users',
            'id_rol' =>'required',
            'password'=>'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
            'estado'=> 'H',
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id==0){
            $usuarios=User::all();
        }
        else{
            $usuarios=User::where('id_rol','=',$id)->get();
        }

        foreach($usuarios as $u){
            if($u->estado=='H'){
                $u->estado="Habilitado";
            }else{
                $u->estado="Deshabilitado";
            }
            if($u->rol_id==1){
                $u->rol_id="Administrador";
            }
            if($u->rol_id==2){
                $u->rol_id="Admisión";
            }
            if($u->rol_id==3){
                $u->rol_id="Medico";
            }
            if($u->rol_id==4){
                $u->rol_id="Farmacia";
            }
        }
        return view('administracion.manejaUsuarios.listarUsuarios',compact('usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::where('id',$id)->delete();
        return redirect()->route('admin.usuarios.show',0);
    }

    public function deshabilitar($id)
    {
        User::where('id','=',$id)->update(['estado'=>'D']);
        return redirect()->route('admin.usuarios.show',0);
    }
    public function habilitar($id)
    {
        User::where('id','=',$id)->update(['estado'=>'H']);
        return redirect()->route('admin.usuarios.show',0);
    }
}