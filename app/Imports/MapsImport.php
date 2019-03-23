<?php
/*
|--------------------------------------------------------------------------
| Prohect Name: SaaS App for mulitiple company
| Author Name: Created By Md Abu Ahsan Basir
| Zend Certified PHP Engineer
| Authour link: 
|--------------------------------------------------------------------------
|
|
*/
namespace App\Imports;

use App\TemporaryMap;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MapsImport implements ToCollection, WithHeadingRow
{
    public $id;
    public $labels = [];
    public $fields = [];
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     $keys = array_keys( $row );
    //     $values = array_values( $row );
    //     $fields[] = $row;
    //     $translate = [
    //         'Imp'           => 'Imp',
    //         'Articolo'      => 'Article',
    //         'Marchio'       => 'Brand name',
    //         'Tipo Strada'   => 'Road type',
    //         'Via'           => 'Street',
    //         'Comune'        => 'Common',
    //         'Pr'            => 'Pr',
    //     ];
    //     //echo "<pre>";
    //     //var_dump($row);
    //     // return new Map([
    //     //     'fields' => $translate
    //     // ]);

    //     return [
    //         'keys' => $keys,
    //         'fileds' => $fields
    //     ];
    // }

    public function collection(Collection $rows)
    {
        
        foreach ($rows[0] as $key => $value) {
            $this->labels[] = $key;
        }
        
        foreach ($rows as $row) 
        {   
            $this->fields[] = $row;
        }

        // var_dump($datas);
        $map = new TemporaryMap;

        $map->fields = $this->fields;
        $map->save();

        $this->id = $map->id;

        // return $map->id;
    }
}
