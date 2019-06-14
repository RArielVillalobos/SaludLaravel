<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


//medicacion
Route::get('medicacion',function (){
    //pendiente
    return datatables()
        ->eloquent(\App\Medicine::query())
        ->addColumn('btn','partials.coordinator.medicacion.actions')
        //renderiza(en formato json) todo, menos los botones, asi se pueden mostar en forma de boton
        ->rawColumns(['btn'])
        ->toJson();

});

