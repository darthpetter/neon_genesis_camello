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
        $usuarios_por_rol = $this->getDistributionUsersByRol();
        $data['usuarios_por_rol'] = $usuarios_por_rol;

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
}
