<?php

namespace App\Exports;

use App\Map;
use Maatwebsite\Excel\Concerns\FromCollection;

class MapsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Map::all();
    }
}
