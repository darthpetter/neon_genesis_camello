<?php

namespace App\Http\Controllers\Reporteria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReporteriaCliController extends Controller
{
    public function index()
    {
        $engage_postulaciones = $this->getEngagePostulaciones();
        $data['engage_postulaciones'] = $engage_postulaciones;

        $avg_monto_postulacion = $this->getAVGMontoSolicitado();
        $data['avg_monto_postulacion'] = $avg_monto_postulacion;

        //Log::info(var_export($data,true));

        return view('reporteria.cliente.index',$data);
    }

    protected function getEngagePostulaciones()
    {
        $postulaciones = DB::select(DB::raw("SELECT 
        CONCAT(LEFT(postulaciones.titulo,15),'...') as postulacion, 
        (
            SELECT COUNT(*) 
            FROM asignacion_postulaciones 
            WHERE asignacion_postulaciones.estado!='E' 
            AND asignacion_postulaciones.id_postulacion=postulaciones.id)
        as postulantes
        FROM postulaciones
        WHERE postulaciones.estado!='E'
        AND postulaciones.id_usuario_creador=".auth()->user()->id."
        GROUP BY postulaciones.id"));

        $data = [];
 
        foreach($postulaciones as $row) {
            $data['label'][] = $row->postulacion;
            $data['data'][] = (int) $row->postulantes;
        }

        return json_encode($data);
    }

    protected function getAVGMontoSolicitado()
    {
        $postulaciones = DB::select(DB::raw("SELECT AVG(asignacion_postulaciones.monto_propuesto) as `promedio`,
        CONCAT(LEFT(postulaciones.titulo,15),'...') as `postulacion`
        FROM postulaciones
        JOIN asignacion_postulaciones ON asignacion_postulaciones.id_postulacion=postulaciones.id
        WHERE postulaciones.estado!='E'
        AND postulaciones.id_usuario_creador=".auth()->user()->id."
        GROUP BY postulaciones.id;"));

        $data = [];
 
        foreach($postulaciones as $row) {
            $data['label'][] = $row->postulacion;
            $data['data'][] = (int) $row->promedio;
        }

        return json_encode($data);
    }
}
