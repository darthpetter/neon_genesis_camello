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

class ReporteriaController extends Controller
{
    public function index()
    {
        Log::info('auth()->user()->id_rol ' . auth()->user()->id_rol);
        switch (auth()->user()->id_rol) {
            case 1:
                return response()->json(['msn' => 'sos admin']);
            case 2:
                return response()->json(['msn' => 'sos admin']);
            case 3:
                $ReporteriaCli=new ReporteriaCliController();
                return $ReporteriaCli->index();
        }
    }
}
