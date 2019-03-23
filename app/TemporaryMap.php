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
namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporaryMap extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fields'
    ];

    /**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
	    'fields' => 'array'
	];
}
