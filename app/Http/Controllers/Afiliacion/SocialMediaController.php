<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Afiliacion\Perfil;
use App\Models\Afiliacion\SocialMediaProfile;
use Illuminate\Support\Facades\Log;


class SocialMediaController extends Controller
{
    public function store(Request $request){
        $socialmedia=Perfil::find(auth()->user()->id)->socialmedia()->first();
        $socialmedia->update($request->only('facebook_profile','instagram_profile','twitter_profile','url_personal'));

        return response()->json([
            'message'=>'Redes sociales actualizadas',
            'status' =>200,
        ],200);
    }

    public function getInfo(){
        $socialmedia=Perfil::find(auth()->user()->id)->socialmedia()->first();
        return response()->json([
            'rrss'=>$socialmedia,
            'status' =>200,
        ],200);
    }
}
