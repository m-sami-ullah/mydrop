<?php 
namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Http\Request;
class Format {

	public  static function date($value,$format_from='Y-m-d',$format_to='Y-m-d')
	{
		return Carbon::createFromFormat($format_from, $value)->format($format_to);
	}
}
