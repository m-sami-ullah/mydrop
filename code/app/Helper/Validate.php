<?php 
namespace App\Helper;

class Validate {



	public static function generate($fields,$exception=[])
	{

		$rules = [];
        $fields = collect($fields);

            $rule = $fields->mapWithKeys(function ($rule,$field) use ($exception) 
            {
            	return [ $field => $rule ];
            }); 
            $rules = array_merge($rules,$rule->toArray());

        return $rules;
	}

	public static function attributes($fields,$exception=[])
	{

		$rules = [];
        $fields = collect($fields);

            $rule = $fields->mapWithKeys(function ($rule,$field) use ($exception) 
            {
                
            	return [ $field =>  $rule ];
            }); 
            $rules = array_merge($rules,$rule->toArray());
        
         

        return $rules;
	}

	
	 

	 
}
