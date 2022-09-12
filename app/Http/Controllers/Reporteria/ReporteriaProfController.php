<?php

namespace App\Http\Controllers\Reporteria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReporteriaProfController extends Controller
{
    public function index()
    {
        $engage_seleccion=$this->getEngageSeleccion();
        $data['engage_seleccion'] = $engage_seleccion;

        return view('reporteria.profesionista.index',$data);
    }

    protected function getEngageSeleccion()
    {
        $engage = DB::select(DB::raw("SELECT * FROM(
            SELECT COUNT(asignacion_postulaciones.id) as num_postulaciones,
            (
                SELECT COUNT(*) 
                FROM postulaciones
                WHERE postulaciones.id_postulante_seleccionado=".auth()->user()->id."
                AND postulaciones.estado!='E'
            ) as num_selecciones,
            DATE_FORMAT(asignacion_postulaciones.created_at,'%d-%m-%y') as fecha
            FROM asignacion_postulaciones
            WHERE asignacion_postulaciones.estado!='E'
            AND asignacion_postulaciones.id_usuario_creador=".auth()->user()->id."
            AND asignacion_postulaciones.created_at<=now()-7
            GROUP BY asignacion_postulaciones.created_at
        )A"));

        $data = [];
 
        foreach($engage as $row) {
            $data['label'][] = $row->fecha;
            $data['data'][] = round((floatval($row->num_selecciones)/floatval($row->num_postulaciones))*100,2);
        }

        return json_encode($data);
    }
    
    protected function get()
    {
        $engage = DB::select(DB::raw("SELECT * FROM(
            SELECT COUNT(asignacion_postulaciones.id) as num_postulaciones,
            (
                SELECT COUNT(*) 
                FROM postulaciones
                WHERE postulaciones.id_postulante_seleccionado=".auth()->user()->id."
                AND postulaciones.estado!='E'
            ) as num_selecciones,
            DATE_FORMAT(asignacion_postulaciones.created_at,'%d-%m-%y') as fecha
            FROM asignacion_postulaciones
            WHERE asignacion_postulaciones.estado!='E'
            AND asignacion_postulaciones.id_usuario_creador=".auth()->user()->id."
            AND asignacion_postulaciones.created_at<=now()-7
            GROUP BY asignacion_postulaciones.created_at
        )A"));

        $data = [];
 
        foreach($engage as $row) 
        {
            $data['label'][] = $row->fecha;
            $data['data'][] = round((floatval($row->num_selecciones)/floatval($row->num_postulaciones))*100,2);
        }

        return json_encode($data);
    }
}
