<?php

namespace App\Http\Controllers\Reporteria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Http;
use App\Http\Controllers\Reporteria\ReporteriaCliController;
use App\Http\Controllers\Reporteria\ReporteriaProfController;

class ReporteriaController extends Controller
{
    public function index()
    {
        switch (auth()->user()->id_rol) {
            case 1:
                $ReporteriaAdm=new ReporteriaAdmController();
                return $ReporteriaAdm->index();
            case 2:
                $ReporteriaProf=new ReporteriaProfController();
                return $ReporteriaProf->index();
            case 3:
                $ReporteriaCli=new ReporteriaCliController();
                return $ReporteriaCli->index();
        }
    }
}
