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

Route::get('Empleadologin','App\Http\Controllers\EmpleadologinController@showLoginForm');

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
Route::resource('Cooperativas', 'App\Http\Controllers\CoopController')->middleware('auth');
Route::resource('PerfilesUsuario', 'App\Http\Controllers\PerfilesUsuarioController')->middleware('auth');
Route::resource('Asistencia', 'App\Http\Controllers\AsistenciaController')->middleware('auth');
Route::resource('Equipos', 'App\Http\Controllers\EquiposController')->middleware('auth');
Route::resource('Seleccion', 'App\Http\Controllers\MultiController');



//Asingaciones
Route::post('viewasigna/{id}','App\Http\Controllers\AsignacionesController@viewasigna');
Route::post('updateasignaciones/{id}','App\Http\Controllers\AsignacionesController@updateasignaciones');
Route::post('deleteasigna/{id}','App\Http\Controllers\AsignacionesController@deleteasigna');

//Empresa
Route::post('SearchUser','App\Http\Controllers\EmpresaController@SearchUser');
Route::post('Empresaphoto','App\Http\Controllers\EmpresaController@Empresaphoto');
Route::post('Empresaupdate/{id}','App\Http\Controllers\EmpresaController@Empresaupdate');
Route::post('harariosave','App\Http\Controllers\EmpresaController@harariosave');
Route::post('DeleteEmpresa/{id}','App\Http\Controllers\EmpresaController@DeleteEmpresa');
Route::post('UpdateHorasEmpresa/{id}','App\Http\Controllers\EmpresaController@UpdateHorasEmpresa');
Route::post('saveUpdate/{id}','App\Http\Controllers\EmpresaController@saveUpdate');



//Multi
Route::post('MultiEmpresa','App\Http\Controllers\MultiController@MultiEmpresa');
Route::post('SeleccionEmpresa','App\Http\Controllers\MultiController@SeleccionEmpresa');



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
Route::get('datatableperfilesUsuarios','App\Http\Controllers\PerfilesUsuarioController@datatableperfilesUsuarios');
Route::get('datatableCoop','App\Http\Controllers\CoopController@datatableCoop');
Route::get('datatablEquipos','App\Http\Controllers\EquiposController@datatablEquipos');
Route::get('datatableAsistencia','App\Http\Controllers\AsistenciaController@datatableAsistencia');
Route::get('datatableHAS','App\Http\Controllers\AsistenciaController@datatableHAS');
Route::get('datatableListado','App\Http\Controllers\ListadoContrller@datatableListado');
Route::get('datatableHorario','App\Http\Controllers\EmpresaController@datatableHorario');


//Empleados
Route::post('savedepart','App\Http\Controllers\EmpleadosController@savedepart');
Route::post('savepago','App\Http\Controllers\EmpleadosController@savepago');
Route::post('savegroup','App\Http\Controllers\EmpleadosController@savegroup');
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
Route::post('Emplephoto','App\Http\Controllers\EmpleadosController@Emplephoto');


//users
Route::post('savedrole','App\Http\Controllers\UserController@savedrole');
Route::post('openadjuntouser','App\Http\Controllers\UserController@openadjuntouser');
Route::post('Gadjuntouser/{id}','App\Http\Controllers\UserController@Gadjuntouser');
Route::post('newadjuntouser','App\Http\Controllers\UserController@newadjuntouser');
Route::post('savejuntouser','App\Http\Controllers\UserController@savejuntouser');
Route::post('downloadContratouser','App\Http\Controllers\UserController@downloadContratouser');

//Grupos
Route::PUT('agregarGruop/{id}','App\Http\Controllers\EquiposController@agregarGruop');
Route::PUT('agregarGruopEdit/{id}','App\Http\Controllers\EquiposController@agregarGruopEdit');
Route::post('AllGroupEDIT','App\Http\Controllers\EquiposController@AllGroupEDIT');
Route::get('AllGroup','App\Http\Controllers\EquiposController@AllGroup');

//Horas
Route::post('updatehoras/{id}','App\Http\Controllers\HorasController@updatehoras');
Route::post('updatehorasListado/{id}','App\Http\Controllers\HorasController@updatehorasListado');
Route::post('deletehoras/{id}','App\Http\Controllers\HorasController@deletehoras');
Route::post('deletehorasListado/{id}','App\Http\Controllers\HorasController@deletehorasListado');
Route::post('savehorasListado/{id}','App\Http\Controllers\HorasController@savehorasListado');
Route::post('showHorasListado/{id}','App\Http\Controllers\HorasController@showHorasListado');


//Cooperativa
Route::PUT('agregarCoop/{id}','App\Http\Controllers\CoopController@agregarCoop');

Route::post('guardar','App\Http\Controllers\EmpleadosController@subir')->name('subir');
//Perfiles
Route::PUT('agregar/{ide}','App\Http\Controllers\PerfilesController@agregar');

//Perfiles De Usuario
Route::PUT('agregarUsuario/{ide}','App\Http\Controllers\PerfilesUsuarioController@agregarUsuario');
Route::PUT('agregarUsuarioEdit/{ide}','App\Http\Controllers\PerfilesUsuarioController@agregarUsuarioEdit');

//Contrato
Route::get('donwload/{file}','App\Http\Controllers\ContratoController@index');

//Asistencia
Route::get('AllGroupAsistencia','App\Http\Controllers\AsistenciaController@AllGroupAsistencia');
Route::post('modaleditFecha/{id}','App\Http\Controllers\AsistenciaController@modaleditFecha');
Route::post('updatefecha/{id}','App\Http\Controllers\AsistenciaController@updatefecha');
Route::post('deletefecha/{id}','App\Http\Controllers\AsistenciaController@deletefecha');

//Horario
Route::post('HorarioEmpresa/{id}','App\Http\Controllers\EmpresaController@HorarioEmpresa');

//Puesto
Route::post('departshow/{id}','App\Http\Controllers\PuestoController@departshow');
Route::post('puestoUpdate/{id}','App\Http\Controllers\PuestoController@puestoUpdate');
Route::post('eliminipuesto/{id}','App\Http\Controllers\PuestoController@eliminipuesto');

//Listado
Route::get('listadopdf/{id}','App\Http\Controllers\ListadoContrller@listadopdf');
Route::get('EmpleRecibopdf/{id}','App\Http\Controllers\ListadoContrller@EmpleRecibopdf');
Route::post('totalnominasListado/{id}','App\Http\Controllers\ListadoContrller@totalnominasListado');
Route::post('DetalleListado/{id}','App\Http\Controllers\ListadoContrller@DetalleListado');
Route::get('incrementoListado/{id}','App\Http\Controllers\ListadoContrller@incrementoListado');
Route::get('otrosListado/{id}','App\Http\Controllers\ListadoContrller@otrosListado');
Route::post('switchetssListado/{id}','App\Http\Controllers\ListadoContrller@switchetssListado');
Route::post('switchetssbonoListado/{id}','App\Http\Controllers\ListadoContrller@switchetssbonoListado');
Route::post('otroseditListado/{id}','App\Http\Controllers\ListadoContrller@otroseditListado');
Route::post('otrosupdateListado/{id}','App\Http\Controllers\ListadoContrller@otrosupdateListado');
Route::post('deleteotrosListado/{id}','App\Http\Controllers\ListadoContrller@deleteotrosListado');
Route::post('Otrosstorea','App\Http\Controllers\ListadoContrller@Otrosstorea');
Route::post('addempleadoListado/{id}','App\Http\Controllers\ListadoContrller@addempleadoListado');
Route::post('deleteempleListado/{id}','App\Http\Controllers\ListadoContrller@deleteempleListado');
Route::get('horasempleListado/{id}','App\Http\Controllers\ListadoContrller@horasempleListado');
Route::post('modalhoursListado/{id}','App\Http\Controllers\ListadoContrller@modalhoursListado');

//Eventos
Route::get('SerchEventos','App\Http\Controllers\EventosController@SerchEventos');


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
Route::post('VerificateHours/{id}','App\Http\Controllers\NominaController@VerificateHours');
Route::post('savegrupos/{id}','App\Http\Controllers\NominaController@savegrupos');
Route::post('modalhours/{id}','App\Http\Controllers\NominaController@modalhours');
Route::post('savehoras/{id}','App\Http\Controllers\NominaController@savehoras');
Route::get('horasemple/{id}','App\Http\Controllers\NominaController@horasemple');
Route::post('showHoras/{id}','App\Http\Controllers\NominaController@showHoras');

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
Route::post('Gastossavefijo/{id}','App\Http\Controllers\GastoController@Gastossavefijo');
Route::get('totalgasto','App\Http\Controllers\GastoController@totalgasto');
Route::post('totalgastoshow/{id}','App\Http\Controllers\GastoController@totalgastoshow');
Route::post('deletegasto/{id}','App\Http\Controllers\GastoController@deletegasto');
Route::post('vernomina/{id}','App\Http\Controllers\GastoController@vernomina');
Route::post('savephone','App\Http\Controllers\GastoController@savephone');
Route::get('phoneblade','App\Http\Controllers\GastoController@phoneblade');
Route::post('conceptelimini/{id}','App\Http\Controllers\GastoController@conceptelimini');
Route::post('modalfijo/{id}','App\Http\Controllers\GastoController@modalfijo');
Route::post('updategasto/{id}','App\Http\Controllers\GastoController@updategasto');
Route::post('modalmodificarFijo/{id}','App\Http\Controllers\GastoController@modalmodificarFijo');
Route::post('modalmodificar/{id}','App\Http\Controllers\GastoController@modalmodificar');

Route::post('deleteconcept/{id}','App\Http\Controllers\GastoController@deleteconcept');
Route::post('deleteconceptFijo/{id}','App\Http\Controllers\GastoController@deleteconceptFijo');

Route::post('updateconceptFijo/{id}','App\Http\Controllers\GastoController@updateconceptFijo');
Route::post('updateconcept/{id}','App\Http\Controllers\GastoController@updateconcept');

Route::post('modalshowmodificar/{id}','App\Http\Controllers\GastoController@modalshowmodificar');
Route::post('updateconceptedit/{id}','App\Http\Controllers\GastoController@updateconceptedit');
Route::post('saveconconcepto/{id}','App\Http\Controllers\GastoController@saveconconcepto');
Route::post('deleteconceptshow/{id}','App\Http\Controllers\GastoController@deleteconceptshow');
Route::post('eliminarnomina/{id}','App\Http\Controllers\GastoController@eliminarnomina');
Route::post('saveFijos','App\Http\Controllers\GastoController@saveFijos');
Route::get('listadopdfgasto/{id}','App\Http\Controllers\GastoController@listadopdfgasto');
Route::get('donwloadgasto/{id}','App\Http\Controllers\GastoController@donwloadgasto');
Route::get('modalcreatefijo','App\Http\Controllers\GastoController@modalcreatefijo');
Route::get('modalcreateedit/{id}','App\Http\Controllers\GastoController@modalcreateedit');
Route::get('saveGastosfijo/{id}','App\Http\Controllers\GastoController@saveGastosfijo');
Route::get('totalgastoConcepto/{id}','App\Http\Controllers\GastoController@totalgastoConcepto');
Route::get('totalgastoFijo/{id}','App\Http\Controllers\GastoController@totalgastoFijo');