<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('chartjs','App\Http\Controllers\HomeController@chartjs');

Route::get('charts', 'UserChartController@index');

Route::group(['middleware' => 'auth'], function () {
	Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
	Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
	Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
	Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
	Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
	Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
	Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//View
Route::resource('Empleados', 'App\Http\Controllers\EmpleadosController')->middleware('auth');
Route::resource('Perfiles', 'App\Http\Controllers\PerfilesController')->middleware('auth');
Route::resource('Listado', 'App\Http\Controllers\ListadoContrller')->middleware('auth');
Route::resource('Roles', 'App\Http\Controllers\RolesController')->middleware('auth');
Route::resource('Pagos', 'App\Http\Controllers\PagosController')->middleware('auth');
Route::resource('Puesto', 'App\Http\Controllers\PuestoController')->middleware('auth');
Route::resource('Puesto', 'App\Http\Controllers\PuestoController')->middleware('auth');
Route::resource('Configuracion', 'App\Http\Controllers\ConfiguracionController')->middleware('auth');
Route::resource('user', 'App\Http\Controllers\UserController')->middleware('auth');
Route::resource('Asignaciones', 'App\Http\Controllers\AsignacionesController')->middleware('auth');
Route::resource('Nominas', 'App\Http\Controllers\NominaController')->middleware('auth');
Route::resource('Otros', 'App\Http\Controllers\OtrosController')->middleware('auth');
Route::resource('Gasto', 'App\Http\Controllers\GastoController')->middleware('auth');
Route::resource('Empresa', 'App\Http\Controllers\EmpresaController')->middleware('auth');
Route::resource('Eventos', 'App\Http\Controllers\EventosController')->middleware('auth');


//Asingaciones
Route::post('viewasigna/{id}','App\Http\Controllers\AsignacionesController@viewasigna');
Route::post('updateasignaciones/{id}','App\Http\Controllers\AsignacionesController@updateasignaciones');
Route::post('deleteasigna/{id}','App\Http\Controllers\AsignacionesController@deleteasigna');


//datatables
Route::get('datatableEmpleado','App\Http\Controllers\EmpleadosController@datatableEmpleado');
Route::get('datatableperfiles','App\Http\Controllers\PerfilesController@datatableperfiles');
Route::get('datatableRoles','App\Http\Controllers\RolesController@datatableRoles');
Route::get('datatablePagos','App\Http\Controllers\PagosController@datatablePagos');
Route::get('datatabledepart','App\Http\Controllers\PuestoController@datatabledepart');
Route::get('datatablesasigna','App\Http\Controllers\AsignacionesController@datatablesasigna');
Route::get('datatable','App\Http\Controllers\NominaController@datatable');
Route::get('datatablegastos','App\Http\Controllers\GastoController@datatablegastos');
Route::get('datatablegastosshowfijo','App\Http\Controllers\GastoController@datatablegastosshowfijo');
Route::get('datatableconcept','App\Http\Controllers\GastoController@datatableconcept');


//Empleados
Route::post('savedepart','App\Http\Controllers\EmpleadosController@savedepart');
Route::post('savepago','App\Http\Controllers\EmpleadosController@savepago');
Route::post('saveasignar','App\Http\Controllers\EmpleadosController@saveasignar');
Route::post('eliminirefern/{id}','App\Http\Controllers\EmpleadosController@eliminirefern');
Route::post('Gadjunto/{id}','App\Http\Controllers\EmpleadosController@Gadjunto');
Route::post('savejunto','App\Http\Controllers\EmpleadosController@savejunto');
Route::post('openadjunto','App\Http\Controllers\EmpleadosController@openadjunto');
Route::post('newadjunto','App\Http\Controllers\EmpleadosController@newadjunto');
Route::get('empleado-pdf','App\Http\Controllers\EmpleadosController@exportarpdf');
Route::post('deleteEadjuto/{id}','App\Http\Controllers\EmpleadosController@deleteEadjuto');
Route::post('emplepaises/{id}','App\Http\Controllers\EmpleadosController@emplepaises');
Route::post('empleciudad/{id}','App\Http\Controllers\EmpleadosController@empleciudad');
Route::post('downloadContrato','App\Http\Controllers\EmpleadosController@downloadContrato');
Route::get('listadopdf','App\Http\Controllers\EmpleadosController@listadopdf');
Route::post('ConverterUsuario','App\Http\Controllers\EmpleadosController@ConverterUsuario');


//users
Route::post('savedrole','App\Http\Controllers\UserController@savedrole');
Route::post('openadjuntouser','App\Http\Controllers\UserController@openadjuntouser');
Route::post('Gadjuntouser/{id}','App\Http\Controllers\UserController@Gadjuntouser');
Route::post('newadjuntouser','App\Http\Controllers\UserController@newadjuntouser');
Route::post('savejuntouser','App\Http\Controllers\UserController@savejuntouser');
Route::post('downloadContratouser','App\Http\Controllers\UserController@downloadContratouser');



Route::post('guardar','App\Http\Controllers\EmpleadosController@subir')->name('subir');
//Perfiles
Route::PUT('agregar/{ide}','App\Http\Controllers\PerfilesController@agregar');

//Contrato
Route::get('donwload/{file}','App\Http\Controllers\ContratoController@index');

//Puesto
Route::post('departshow/{id}','App\Http\Controllers\PuestoController@departshow');
Route::post('puestoUpdate/{id}','App\Http\Controllers\PuestoController@puestoUpdate');
Route::post('eliminipuesto/{id}','App\Http\Controllers\PuestoController@eliminipuesto');

//Listado
Route::get('listadopdf/{id}','App\Http\Controllers\ListadoContrller@listadopdf');


//Nominas
Route::post('addempleado/{id}','App\Http\Controllers\NominaController@addempleado');
Route::post('totalnominas/{id}','App\Http\Controllers\NominaController@totalnominas');
Route::post('verEmpleado/{id}','App\Http\Controllers\NominaController@verEmpleado');
Route::post('switchetss/{id}','App\Http\Controllers\NominaController@switchetss');
Route::post('switchetssisr/{id}','App\Http\Controllers\NominaController@switchetssisr');
Route::post('switchetssbono/{id}','App\Http\Controllers\NominaController@switchetssbono');
Route::get('Detalle/{id}','App\Http\Controllers\NominaController@Detalle');
Route::get('incremento/{id}','App\Http\Controllers\NominaController@incremento');
Route::get('otros/{id}','App\Http\Controllers\NominaController@otros');
Route::post('deleteemple/{id}','App\Http\Controllers\NominaController@deleteemple');

//Pagos
Route::post('Pagosshow/{id}','App\Http\Controllers\PagosController@Pagosshow');
Route::post('PagoUpdate/{id}','App\Http\Controllers\PagosController@PagoUpdate');
Route::post('eliminipagos/{id}','App\Http\Controllers\PagosController@eliminipagos');

//Otros
Route::post('otrosedit/{id}','App\Http\Controllers\OtrosController@otrosedit');
Route::post('otrosupdate/{id}','App\Http\Controllers\OtrosController@otrosupdate');
Route::post('deleteotros/{id}','App\Http\Controllers\OtrosController@deleteotros');

//Gasto
Route::post('listmonto/{id}','App\Http\Controllers\GastoController@listmonto');
Route::get('GastosFijo','App\Http\Controllers\GastoController@GastosFijo');
Route::post('Gastossavefijo','App\Http\Controllers\GastoController@Gastossavefijo');
Route::get('totalgasto','App\Http\Controllers\GastoController@totalgasto');
Route::post('totalgastoshow/{id}','App\Http\Controllers\GastoController@totalgastoshow');
Route::post('deletegasto/{id}','App\Http\Controllers\GastoController@deletegasto');
Route::post('vernomina/{id}','App\Http\Controllers\GastoController@vernomina');
Route::post('savephone','App\Http\Controllers\GastoController@savephone');
Route::get('phoneblade','App\Http\Controllers\GastoController@phoneblade');
Route::post('conceptelimini/{id}','App\Http\Controllers\GastoController@conceptelimini');
Route::post('modalfijo/{id}','App\Http\Controllers\GastoController@modalfijo');
Route::post('updategasto/{id}','App\Http\Controllers\GastoController@updategasto');
Route::post('modalmodificar/{id}','App\Http\Controllers\GastoController@modalmodificar');
Route::post('deleteconcept/{id}','App\Http\Controllers\GastoController@deleteconcept');
Route::post('updateconcept/{id}','App\Http\Controllers\GastoController@updateconcept');
Route::post('modalshowmodificar/{id}','App\Http\Controllers\GastoController@modalshowmodificar');
Route::post('updateconceptedit/{id}','App\Http\Controllers\GastoController@updateconceptedit');
Route::post('saveconconcepto/{id}','App\Http\Controllers\GastoController@saveconconcepto');
Route::post('deleteconceptshow/{id}','App\Http\Controllers\GastoController@deleteconceptshow');
Route::post('eliminarnomina/{id}','App\Http\Controllers\GastoController@eliminarnomina');
Route::get('listadopdfgasto/{id}','App\Http\Controllers\GastoController@listadopdfgasto');
Route::get('donwloadgasto/{id}','App\Http\Controllers\GastoController@donwloadgasto');
Route::post('observacion/{id}','App\Http\Controllers\GastoController@observacion');
Route::get('modalcreatefijo','App\Http\Controllers\GastoController@modalcreatefijo');