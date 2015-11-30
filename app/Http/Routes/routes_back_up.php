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


/*Mi login*/


Route::get('usuarios/newUsuario',['as'=>'viewNewUsuario','uses'=>'UsuarioController@viewNewUsuario']);
Route::get('usuarios/firstUser',['as'=>'firstUser','uses'=>'UsuarioController@registerUser']);
Route::post('usuarios/loginUser',['as'=>'loginUser','uses'=>'UsuarioController@login']);
Route::get('usuarios/outLogin',['as'=>'outLogin','uses'=>'UsuarioController@outLogin']);


/**/

Route::get('help/token',['as'=>'getToken','uses'=>'HelperController@token']);

/*Modulo de proveedores*/
Route::get('proveedores', ['as' => 'proveedores']);
Route::get('proveedores/all', ['middleware' => 'auth','as' => 'proveedoresAll', 'uses' => 'ProveedoresController@selectAllProveedores']);
Route::get('proveedores/getBy/{criterio?}-{dni}', ['as' => 'proveedoresByCriterio', 'uses' => 'ProveedoresController@getProveedoresByCriterio']);
Route::get('proveedores/newProveedor',['as'=>'viewNewProveedor','uses'=>'ProveedoresController@getViewNewProveedor']);
Route::post('proveedores/regProveedor',['as'=>'regProveedor','uses'=>'ProveedoresController@regProveedor']);
Route::get('proveedores/updateProveedor/{id}',['as'=>'updateProveedor','uses'=>'ProveedoresController@getViewUpdateProveedor']);
Route::get('proveedores/getProveedor/{id}',['as'=>'getProveedorByID','uses' => 'ProveedoresController@getProveedorByID']);
Route::post('proveedores/updateProveedor',['as'=>'updateDataProveedor','uses' => 'ProveedoresController@updateDataProveedor']);
Route::get('proveedores/deteleProveedor/{id}',['as'=>'deteleProveedor','uses'=>'ProveedoresController@deteleProveedor']);

/*Service proveedor*/
Route::post('proveedores/getProveedorByDNI',['as'=>'getProveedorByDNIService','uses'=>'ProveedoresController@getProveedorByDNIService']);


/*Modulo de rutas*/
Route::get('rutas',['as'=>'rutas']);
Route::get('rutas/all',['as'=>'rutasAll','uses'=>'RutasController@selectAllRutas']);
Route::post('rutas/regRuta',['as'=>'regRuta','uses'=>'RutasController@regRuta']);
Route::post('rutas/updateRuta',['as'=>'updateRuta','uses'=>'RutasController@updateRuta']);
Route::get('rutas/getRutaById/{id}',['as'=>'getRutaById','uses'=>'RutasController@getRutaById']);
Route::get('rutas/deleteRuta/{id}',['as'=>'deleteRuta','uses'=>'RutasController@deleteRuta']);


include('Routes/routes_admin.php');



/*Modulo de Anexos*/
Route::get('anexos',['as'=>'anexos']);
Route::get('anexos/all',['as'=>'anexosAll','uses'=>'AnexosController@selectAllRutas']);
Route::post('anexos/regAnexo',['as'=>'regAnexo','uses'=>'AnexosController@regAnexo']);
Route::post('anexos/updateAnexo',['as'=>'updateAnexo','uses'=>'AnexosController@updateAnexo']);
Route::get('anexos/deleteAnexo/{id}',['as'=>'deleteAnexo','uses'=>'AnexosController@deleteAnexo']);


//para los helper
Route::get('helper/getAnexoByRuta/',['as'=>'getAnexos']);
Route::get('helper/getAnexoByRuta/{id}',['as'=>'get','uses'=>'HelperController@getAnexoByRuta']);


//para el acopio
Route::get('Control_Calidad',['as'=>'modControlCalidad']);
Route::get('Control_Calidad/Acopio/',['as'=>'getAcopio']);
Route::get('Control_Calidad/deleteAcopio/{id}',['as'=>'deleteAcopio','uses'=>'AcopioController@deleteAcopio']);
Route::get('Control_Calidad/Acopio/all',['as'=>'getAcopioAll','uses'=>'AcopioController@index']);
Route::get('Control_Calidad/Acopio/{anexo}',['as'=>'getAcopioByAnexo','uses'=>'AcopioController@getProveedoresByAnexo']);
Route::get('Control_Calidad/getAcopioByProveedor/{id}',['as'=>'getAcopioByProveedor','uses'=>'AcopioController@getAcopioByProveedor']);
Route::post('Control_Calidad/Acopio/reg',['as'=>'regAcopio','uses'=>'AcopioController@regAcopio']);
Route::post('Control_Calidad/getAcopioByProveedorAndFechas/',['as'=>'getAcopioByProveedorAndFechas','uses' =>'AcopioController@getAcopioByProveedorAndFechas']);
Route::post('Control_Calidad/getAcopioById/',['as'=>'getAcopioById','uses'=>'AcopioController@getAcopioById']);
//return suma Json de los acopios
Route::post('Control_Calidad/getSumaAcopioByProveedorAndFechas/',['as'=>'getSumaAcopioByProveedorAndFechas','uses' =>'AcopioController@getSumaAcopioByProveedorAndFechas']);
Route::post('Control_Calidad/updateAcopio',['as'=>'updateAcopio','uses'=>'AcopioController@updateAcopio']);




Route::get('acopio/prueba',['as'=>'prueba','uses'=>'AcopioController@prueba']);



//modulo de insidencias
Route::get('Control_Calidad/InsidenciaForAcopio/{$id}',['as'=>'a']);
Route::post('Control_Calidad/RegInsidencia',['as'=>'RegInsidencia','uses'=>'InsidenciaController@RegInsidencia']);
Route::post('Control_Calidad/UpdateInsidencia',['as'=>'UpdateInsidencia','uses'=>'InsidenciaController@UpdateInsidencia']);
Route::post('Control_Calidad/getInsidenciaByAcopio',['as'=>'getInsidenciaByAcopio'
    ,'uses'=>'InsidenciaController@getInsidenciaByAcopio']);
Route::get('Control_Calidad/deleteInsidencia/{id}',['as'=>'deleteInsidencia'
    ,'uses'=>'InsidenciaController@deleteInsidencia']);





//modulo de liquidacion
Route::get('liquidacion',['as'=>'modLiquidacion']);
Route::post('liquidacion/getLiquidacionById',['as'=>'getLiquidacionById','uses'=>'LiquidacionController@getLiquidacionById']);
Route::get('liquidacion/getAllLiquidacion',['as'=>'getAllLiquidacion','uses'=>'LiquidacionController@getAllLiquidacion']);
Route::post('liquidacion/getAllLiquidacionByParameters',['as'=>'getAllLiquidacionByParameters','uses'=>'LiquidacionController@getAllLiquidacionByParameters']);
Route::get('liquidacion/viewNewLiquidacion',['as'=>'viewNewLiquidacion','uses'=>'LiquidacionController@viewNewLiquidacion']);
Route::post('liquidacion/regLiquidacion',['as'=>'regLiquidacion','uses'=>'LiquidacionController@regLiquidacion']);
Route::get('liquidacion/getViewEditLiquidacion/{id}',['as'=>'getViewEditLiquidacion','uses'=>'LiquidacionController@getViewEditLiquidacion']);
Route::post('liquidacion/upLiquidacion',['as'=>'upLiquidacion','uses'=>'LiquidacionController@upLiquidacion']);
Route::get('liquidacion/deleteLiquidacion/{id}',['as'=>'deleteLiquidacion','uses'=>'LiquidacionController@deleteLiquidacion']);




//modulo de prestamos
Route::get('prestamos',['as'=>'modPrestamos']);
Route::get('prestamos/getAllPrestamos',['as'=>'getAllPrestamos','uses'=>'PrestamosController@getAllPrestamos']);
Route::get('prestamos/getProveedoresForPrestamos',['as'=>'getProveedoresForPrestamos','uses'=>'PrestamosController@getProveedoresForPrestamos']);
Route::get('prestamos/getPrestamoByProveedor/{id}',['as'=>'getPrestamoByProveedor','uses'=>'PrestamosController@getPrestamoByProveedor']);
Route::get('prestamos/getViewNewPrestamo',['as'=>'getViewNewPrestamo','uses'=>'PrestamosController@getViewNewPrestamo']);
Route::post('prestamos/regPrestamo',['as'=>'regPrestamo','uses'=>'PrestamosController@regPrestamo']);
Route::post('prestamos/getPrestamosByParams',['as'=>'getPrestamosByParams','uses'=>'PrestamosController@getPrestamosByParams']);
Route::get('prestamos/getViewUpPrestamo/{id}',['as'=>'getViewUpPrestamo','uses'=>'PrestamosController@getViewUpPrestamo']);
Route::post('prestamos/getPrestamoById',['as'=>'getPrestamoById','uses'=>'PrestamosController@getPrestamoById']);
Route::post('prestamos/updatePrestamo',['as'=>'updatePrestamo','uses'=>'PrestamosController@updatePrestamo']);
Route::get('prestamos/deletePrestamo/{id}',['as'=>'deletePrestamo','uses'=>'PrestamosController@deletePrestamo']);




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