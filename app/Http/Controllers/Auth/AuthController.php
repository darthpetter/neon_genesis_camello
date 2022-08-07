<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

use App\Models\Afiliacion\Perfil;
use App\Models\Afiliacion\SocialMediaProfile;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registro(Request $request){
        $validator=$this->validator($request);

        if($validator->fails()){            
            return response()->json([
                'messages'=>$validator->errors(),
                'status'=>400
            ],200);
        }

        $user=User::factory()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'id_rol'=>$request->id_rol,
        ]);
        $perfil=new Perfil();
        $perfil->user()->associate($user)->save();

        $socialmedia=SocialMediaProfile::create([]);
        $perfil->socialmedia()->associate($socialmedia)->save();

        $token= $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer',
            'status'=>200
        ],200);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message'=>'Invalid login details',
                'status'=>401
            ],200);
        }
        
        $user=User::where('email',$request['email'])->firstOrFail();

        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer',
            'status'=>200,
        ],200);
    }
    public function userinfo(Request $request){
        return $request->user();
    }

    protected function validator(Request $request){
        return Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8',
            'id_rol'=>'required|exists:tbr_roles,id'
        ]);
    }

    public function getUserData(){
        $user=User::find(auth()->user()->id);
        return response()->json([
            'status'=>200,
            'user'=>$user,
        ],200);
    }
}
