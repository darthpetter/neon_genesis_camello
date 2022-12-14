<?php

use App\Http\Controllers\Afiliacion\PerfilController;
use App\Http\Controllers\Afiliacion\SocialMediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Postulaciones\PostulacionController;
use App\Http\Controllers\Reporteria\ReporteriaController;
use App\Http\Controllers\Reporteria\ReporteriaAdmController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingpage.index');
});

Route::controller(AuthController::class)->group(function () {
    //Route::post('/login', 'login');
    Route::post('/register', ['uses'=>'registro','as'=>'registro']);
});




Route::get('/explore',function(){
    return view('postulaciones.explore_postulaciones');
});
//Mayores de edad
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::controller(ReporteriaController::class)->group(function(){
            Route::get('/estadisticas','index')->name('estadisticas');
        });
        
        Route::controller(PerfilController::class)->group(function(){
            Route::get('/completar_formulario','index')->name('completar_formulario');
            Route::post('/perfil_store','store')->name('perfil.store');
            Route::get('/perfil','getPerfil')->name('perfil');
        });
        Route::controller(SocialMediaController::class)->group(function(){
            Route::post('/rrss_store','store')->name('rrss.store');
        });

        Route::get('/postulaciones','App\Http\Controllers\Postulaciones\PostulacionController@index')->name('postulaciones');
        
        Route::middleware(['rolAccess:CLIENTE'])->group(function () {
            Route::controller(PostulacionController::class)->group(function (){
                Route::get('/postulacion/{id}','detallePostulacionCli');
                Route::post('/postulacion','store')->name('postulacion.create');
                Route::delete('/postulacion','eliminarPostulacion')->name('postulacion.eliminar');
                Route::post('/postulacion_seleccion','seleccionPostulante')->name('postulacion.seleccion');
            });
        });
        Route::middleware(['rolAccess:PROFESIONISTA'])->group(function () {
            Route::controller(PostulacionController::class)->group(function (){
                Route::get('/postulacion_detalle/{id}','detallePostulacionProf');
                Route::post('/postularse','postularse')->name('profesionista.postularse');
            });
        });

});
