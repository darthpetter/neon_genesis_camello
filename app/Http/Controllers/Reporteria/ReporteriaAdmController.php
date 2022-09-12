<?php

namespace App\Http\Controllers\Reporteria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Postulaciones\Postulacion;

class ReporteriaAdmController extends Controller
{
    public function index()
    {
        $usuarios_por_rol = $this->getDistributionUsersByRol();
        $data['usuarios_por_rol'] = $usuarios_por_rol;
        $postulaciones_por_alabor= $this->getDistribucionALaborMasSolicitada();
        $data['postulaciones_por_alabor']=$postulaciones_por_alabor;
        $asignaciones_por_labor= $this->getDistribucionALaborMasAsignada();
        $data['asignaciones_por_labor']=$asignaciones_por_labor;

        return view('reporteria.administrador.index', $data);
    }

    protected function getDistributionUsersByRol()
    {
        $users = User::select(DB::raw('COUNT(users.id) as num_usuarios'), 'roles.name as rol')
            ->join('roles', 'roles.id', '=', 'users.id_rol')
            ->groupBy('roles.id')
            ->get();

        $data = [];

        foreach ($users as $row) {
            $data['label'][] = $row->rol;
            $data['data'][] = (int) $row->num_usuarios;
        }

        return json_encode($data);
    }
    
    protected function getDistribucionALaborMasSolicitada()
    {
        $areas_labor = Postulacion::select('areas_labor.nombre as area_labor',DB::raw('COUNT(postulaciones.id) as num_postulaciones'))
        ->join('areas_labor','areas_labor.id','=','postulaciones.id_area_labor')
        ->where('postulaciones.estado','!=','E')
        ->groupBy('areas_labor.id')
        ->get();

        $data = [];

        foreach ($areas_labor as $row) {
            $data['label'][] = $row->area_labor;
            $data['data'][] = (int) $row->num_postulaciones;
        }

        return json_encode($data);
    }
    protected function getDistribucionALaborMasAsignada()
    {
        $areas_labor = Postulacion::select('areas_labor.nombre as area_labor',DB::raw('COUNT(asignacion_postulaciones.id) as num_asignaciones'))
        ->join('areas_labor','areas_labor.id','=','postulaciones.id_area_labor')
        ->join('asignacion_postulaciones','asignacion_postulaciones.id_postulacion','=','postulaciones.id')
        ->where('postulaciones.estado','!=','E')
        ->where('asignacion_postulaciones.estado','!=','E')
        ->groupBy('areas_labor.id')->groupBy('postulaciones.id')
        ->get();

        $data = [];

        foreach ($areas_labor as $row) {
            $data['label'][] = $row->area_labor;
            $data['data'][] = (int) $row->num_asignaciones;
        }

        return json_encode($data);
    }
}
