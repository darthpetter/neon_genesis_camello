<?php

namespace App\Http\Controllers\Reporteria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ReporteriaAdmController extends Controller
{
    public function index()
    {
        $user= User::select(DB::raw('COUNT(*) as count'),'roles.name as rol')
        ->join('roles','roles.id','=','users.id_rol')
        ->groupBy('users.id_rol')
        ->orderBy('users.id_rol')
        ->get();
        
        $data = [];
 
        foreach($user as $row) {
            Log::info($row);
            $data['label'][] = $row->rol;
            $data['data'][] = (int) $row->count;
        }

        $data['chart_data'] = json_encode($data);
        return view('reporteria.index',$data);
    }
}
