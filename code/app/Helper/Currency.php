<?php 
namespace App\Helper;

use Carbon\Carbon;
class Currency {

	public static function round($value,$pre=2)
	{
		return round($value,$pre);
	}
	    
	public static function currency($value, $currency=null)
	{
		$symbol = static::symbol();
		
		return $symbol . number_format( $value / 100 , 2, '.', ',');
	}

	public static function symbol()
  	{
	  		return 'USD';
  	}  	
}
