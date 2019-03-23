<?php
/*
|--------------------------------------------------------------------------
| Prohect Name: SaaS App for mulitiple company
| Author Name: Created By Md Abu Ahsan Basir
| Zend Certified PHP Engineer
| Authour link: http://www.zend.com/en/yellow-pages/ZEND030936
|--------------------------------------------------------------------------
|
|
*/
namespace App\Http\Controllers;

use App\Exports\MapsExport;
use App\Imports\MapsImport;
use App\Map;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MapController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('excel');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new MapsExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        $import = new MapsImport;
        Excel::import( $import,request()->file('file'));
        // echo "<pre>";
        // var_dump( Map::find($import->id) );
           
        // return back();
    }
}
