<?php

use App\Map;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Route::get('/map', function(){
	$datas = Map::all();
	return view('map', compact('datas'));
});

Route::post('/getMapData', function( Request $request ){

	$data = Map::all();

	echo json_encode( $data );
});

Route::post('/getSingleMap', function( Request $request ){

	$data = Map::find($request->id);

	echo json_encode( $data );
});

Route::get('/getMapData', function( Request $request ){
	$homepage = file_get_contents('http://themestarz.net/html/locations/assets/external/data.php');

	$data = json_decode( $homepage, $assoc_array = false );
	echo "<pre>";
	var_dump( $data );
});
