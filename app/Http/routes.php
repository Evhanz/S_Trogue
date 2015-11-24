<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as'=>'home','uses'=>'WelcomeController@index'] );

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::get('help/token',['as'=>'getToken','uses'=>'HelperController@token']);

/*Modulo de proveedores*/
Route::get('proveedores', ['as' => 'proveedores']);
Route::get('proveedores/all', ['as' => 'proveedoresAll', 'uses' => 'ProveedoresController@selectAllProveedores']);
Route::get('proveedores/getBy/{criterio?}-{dni}', ['as' => 'proveedoresByCriterio', 'uses' => 'ProveedoresController@getProveedoresByCriterio']);
Route::get('proveedores/newProveedor',['as'=>'viewNewProveedor','uses'=>'ProveedoresController@getViewNewProveedor']);
Route::post('proveedores/regProveedor',['as'=>'regProveedor','uses'=>'ProveedoresController@regProveedor']);
Route::get('proveedores/updateProveedor/{id}',['as'=>'updateProveedor','uses'=>'ProveedoresController@getViewUpdateProveedor']);
Route::get('proveedores/getProveedor/{id}',['as'=>'getProveedorByID','uses' => 'ProveedoresController@getProveedorByID']);
Route::post('proveedores/updateProveedor',['as'=>'updateDataProveedor','uses' => 'ProveedoresController@updateDataProveedor']);
/*Service proveedor*/
Route::post('proveedores/getProveedorByDNI',['as'=>'getProveedorByDNIService','uses'=>'ProveedoresController@getProveedorByDNIService']);



/*Modulo de rutas*/
Route::get('rutas',['as'=>'rutas']);
Route::get('rutas/all',['as'=>'rutasAll','uses'=>'RutasController@selectAllRutas']);
Route::post('rutas/regRuta',['as'=>'regRuta','uses'=>'RutasController@regRuta']);


/*Modulo de Anexos*/
Route::get('anexos',['as'=>'anexos']);
Route::get('anexos/all',['as'=>'anexosAll','uses'=>'AnexosController@selectAllRutas']);
Route::post('anexos/regAnexo',['as'=>'regAnexo','uses'=>'AnexosController@regAnexo']);


//para los helper
Route::get('helper/getAnexoByRuta/',['as'=>'getAnexos']);
Route::get('helper/getAnexoByRuta/{id}',['as'=>'get','uses'=>'HelperController@getAnexoByRuta']);


//para el acopio
Route::get('Control_Calidad/Acopio/',['as'=>'getAcopio']);
Route::get('Control_Calidad/Acopio/all',['as'=>'getAcopioAll','uses'=>'AcopioController@index']);
Route::get('Control_Calidad/Acopio/{anexo}',['as'=>'getAcopioByAnexo','uses'=>'AcopioController@getProveedoresByAnexo']);
Route::get('Control_Calidad/getAcopioByProveedor/{id}',['as'=>'getAcopioByProveedor','uses'=>'AcopioController@getAcopioByProveedor']);
Route::post('Control_Calidad/Acopio/reg',['as'=>'regAcopio','uses'=>'AcopioController@regAcopio']);
Route::post('Control_Calidad/getAcopioByProveedorAndFechas/',['as'=>'getAcopioByProveedorAndFechas','uses' =>'AcopioController@getAcopioByProveedorAndFechas']);
Route::post('Control_Calidad/getAcopioById/',['as'=>'getAcopioById','uses'=>'AcopioController@getAcopioById']);
//return suma Json
Route::post('Control_Calidad/getSumaAcopioByProveedorAndFechas/',['as'=>'getSumaAcopioByProveedorAndFechas','uses' =>'AcopioController@getSumaAcopioByProveedorAndFechas']);




Route::get('acopio/prueba',['as'=>'prueba','uses'=>'AcopioController@prueba']);



//modulo de insidencias
Route::get('Control_Calidad/InsidenciaForAcopio/{$id}',['as'=>'a']);
Route::post('Control_Calidad/RegInsidencia',['as'=>'RegInsidencia','uses'=>'InsidenciaController@RegInsidencia']);


//modulo de liquidacion
Route::get('liquidacion',['as'=>'modLiquidacion']);
Route::get('liquidacion/getAllLiquidacion',['as'=>'getAllLiquidacion','uses'=>'LiquidacionController@getAllLiquidacion']);
Route::post('liquidacion/getAllLiquidacionByParameters',['as'=>'getAllLiquidacionByParameters','uses'=>'LiquidacionController@getAllLiquidacionByParameters']);
Route::get('liquidacion/viewNewLiquidacion',['as'=>'viewNewLiquidacion','uses'=>'LiquidacionController@viewNewLiquidacion']);
Route::post('liquidacion/regLiquidacion',['as'=>'regLiquidacion','uses'=>'LiquidacionController@regLiquidacion']);


//modulo de prestamos
Route::get('prestamos',['as'=>'modPrestamos']);
Route::get('prestamos/getAllPrestamos',['as'=>'getAllPrestamos','uses'=>'PrestamosController@getAllPrestamos']);
Route::get('prestamos/getProveedoresForPrestamos',['as'=>'getProveedoresForPrestamos','uses'=>'PrestamosController@getProveedoresForPrestamos']);
Route::get('prestamos/getPrestamoByProveedor/{id}',['as'=>'getPrestamoByProveedor','uses'=>'PrestamosController@getPrestamoByProveedor']);
Route::get('prestamos/getViewNewPrestamo',['as'=>'getViewNewPrestamo','uses'=>'PrestamosController@getViewNewPrestamo']);
Route::post('prestamos/regPrestamo',['as'=>'regPrestamo','uses'=>'PrestamosController@regPrestamo']);

//Modulo de pagos a terceros
Route::get('venta_terceros',['as'=>'modVentasTerceros']);
Route::get('venta_terceros/getViewNewVentaTerceros',['as'=>'getViewNewVentaTerceros','uses'=>'VentaTercerosController@getViewNewVentaTerceros']);
Route::post('venta_terceros/regVentaTerceros',['as'=>'RegVentaTerceros','uses'=>'VentaTercerosController@RegVentaTerceros']);
Route::get('venta_terceros/getAllVentaTerceros',['as'=>'getAllVentaTerceros','uses'=>'VentaTercerosController@getAllVentaTerceros']);



//Modulo de Recursos
Route::get('recursos',['as'=>'modRecursos']);
Route::get('recursos/vieModRecursos',['as'=>'getvieModRecursos','uses'=>'RecursoController@getvieModRecursos']);
Route::post('recursos/regRecursos',['as'=>'regRecurso','uses'=>'RecursoController@regRecurso']);

//modulo de pagos
Route::get('pagos',['as'=>'ModPagos']);
Route::get('pagos/viewAllPagos',['as'=>'viewAllPagos','uses'=>'PagoController@viewAllPagos']);
Route::get('pagos/viewNewPago',['as'=>'viewNewPago','uses'=>'PagoController@viewNewPago']);
Route::post('pagos/RegPago',['as'=>'RegPago','uses'=>'PagoController@RegPago']);


/*Api*/
Route::post('api/proveedor/getWithPrestamosAndLetras',['as'=>'ApigetWithPrestamosAndLetras', 'uses' => 'ProveedoresController@ServiceGetWithPrestamosAndLetras']);
Route::post('api/acopio/now',['as'=>'ApiGetAcopioByDay','uses'=>'AcopioController@getAcopioByDay']);
Route::post('api/liquidacion/getLiquidacionByNumber',['as'=>'ApiGetLiquidacionByNumber','uses'=>'LiquidacionController@getLiquidacionByNumber']);
Route::get('api/helper/getDataCore',['as'=>'getDataCore','uses'=>'HelperController@getDataCore']);


/*solo apra pruebas*/
Route::post('sync/reqDataSyncPesoBalanza',['as'=>'reqDataSyncPesoBalanza','uses'=>'HelperController@reqDataSyncPesoBalanza']);