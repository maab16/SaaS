<?php

use App\Imports\MapsImport;
use App\Map;
use App\TemporaryMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Geotools\Coordinate\Coordinate;
use League\Geotools\Coordinate\Ellipsoid;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
| Prohect Name: SaaS App for mulitiple company
| Author Name: Created By Md Abu Ahsan Basir
| Zend Certified PHP Engineer
| Authour link: 
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

Route::get('/map/{id}', function($id){
  $map_id = $id;
	$datas = Map::where('map_name',$map_id)->get();
	return view('map', compact('datas','map_id'));
});

Route::post('/getMapData', function( Request $request ){

	$data = Map::where('map_name',$request->map_id)->get();

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


Route::get('export', 'MapController@export')->name('export');
Route::get('importExportView', 'MapController@importExportView');
Route::post('import', 'MapController@import')->name('import');

Route::get('/map/fields/{id}', function(Request $request) {
	$data = Map::find($request->id);
	echo "<pre>";
	var_dump($data->fields);
});

Route::get('import', function() {
	return view('import');
});

Route::post('importData', function( Request $request ){
	if($request->ajax()) {
		if($request->hasFile('files')) {
           $files = $request->file('files');
           $results = [];
           $datas = [];
           foreach ($files as $file) {
           		$extenstion = $file->getClientOriginalExtension();
           		$fileName = rand().'.'.$extenstion;
           		$results[] = $fileName;
           		if($extenstion == 'xlsx' || $extenstion == 'XLSX' || $extenstion == 'XLS' || $extenstion == 'xls'){
           			$import = new MapsImport;
           			$data = Excel::import($import, $file);
           			$datas[] = TemporaryMap::find($import->id);
                $labels = $import->labels;
                session()->put('fields', $import->fields);
                $map = Map::all();

                // get the column names for the table
                $columns = Schema::getColumnListing('maps');
                // create array where column names are keys, and values are null
                $columns = array_fill_keys($columns, null);
           		}else {
           			$error = "We support only xlsx or xls (excel file) but upload ".$extenstion.". Please upload a valid file.";
           			return response()->json(['error'=> $error]);
           		}
           		
           }
        }
  		return response()->json([
        'success'   => true,
        'data'      => $datas,
        'labels'    => $labels,
        'columns'   => $columns
      ]);
	}
});


Route::post('/saveMap', function(Request $request){
  if($request->ajax()) {
    if(session()->has('fields')) {
      $fields = session('fields');
    } 
    $columns = $request->fields;

    $errors = [];

    if( $fields ) {
      $map_name = (isset($columns['map_name'])) ? str_replace(' ', '_', $columns['map_name']) : rand();
      foreach ($fields as $key => $field) {

        $full_address = (isset($columns['full_address'])) ? $field[$columns['full_address']] : null;
        $state = (isset($columns['state'])) ? $field[$columns['state']] : null;
        $province = (isset($columns['province'])) ? $field[$columns['province']] : null;
        $city = (isset($columns['city'])) ? $field[$columns['city']] : null;
        $street = (isset($columns['street'])) ? $field[$columns['street']] : null;
        $postal_code = (isset($columns['postal_code'])) ? $field[$columns['postal_code']] : null;
        $company = (isset($columns['company'])) ? $field[$columns['company']] : null;
        $website = (isset($columns['website'])) ? $field[$columns['website']] : null;
        $email = (isset($columns['email'])) ? $field[$columns['email']] : null;
        $telephone = (isset($columns['telephone'])) ? $field[$columns['telephone']] : null;

        $latitudeCoordinate = (isset($columns['latitude'])) ? $field[$columns['latitude']] : null;
        $longitudeCoordinate = (isset($columns['longitude'])) ? $field[$columns['longitude']] : null;

        if( !$latitudeCoordinate || !$longitudeCoordinate ) {
          $errors['lat_long'] = "You must provide both latitude and longitude coordinates";
        }

        if( $latitudeCoordinate && $longitudeCoordinate ) {
          $coordinate = new Coordinate("$latitudeCoordinate, $longitudeCoordinate");
          $latitude = $coordinate->getLatitude();
          $longitude = $coordinate->getLongitude();
        }

        

        $map = new Map;

        $map->map_name = $map_name;
        $map->full_address = $full_address;
        $map->state = $state;
        $map->province = $full_address;
        $map->city = $city;
        $map->street = $street;
        $map->street = $street;
        $map->postal_code = $postal_code;
        $map->latitude = $latitude;
        $map->longitude = $longitude;
        $map->company = $company;
        $map->website = $website;
        $map->email = $email;
        $map->telephone = $telephone;
        
        $map->save();
      }

      return response()->json([
          'success'   => true,
          'map_name'  => $map_name
        ]);
    }

    if(!empty($errors)) {
      return response()->json([
          'success'   => false,
          'errors'  => $errors
        ]);
    }
    
    }
});

Route::get('DMStoDD',function(Request $request){
  if(session()->has('fields')) {
    echo "<pre>";
    var_dump(session('fields'));
  }
  
  $coordinate = new Coordinate('48°49′24″N, 2°18′26″E');
  printf("Latitude: %F\n", $coordinate->getLatitude()); // 48.8234055
  printf("Longitude: %F\n", $coordinate->getLongitude()); // 2.3072664
});