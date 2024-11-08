<?php 
namespace App\Helper;
use Illuminate\Support\Collection;

class Functions {


	public static function select($obj,$fields=['id','name'],$selected=null,$default=true,$data_attrib=[],$merge_fields=[],$merge_character='')
	{
		
		if ($selected instanceof Collection) 
        {
        	$selected_idz      = $selected->pluck('id')->toArray();
        }else if(!is_array($selected) && $selected!=null){
            $selected_idz[]    = $selected;
        }else{

        	$selected_idz      = $selected;
        } 

    	$selectField = array_key_exists(0,$fields) ?  $fields[0] : 'id';
    	$field_name  = array_key_exists(1,$fields) ?  $fields[1] : 'name';
        
		$select = '';
		if ($obj instanceof Collection) 
		{
			($default)? $select .= '<option value="">--select--</option>':'';
			foreach ($obj as $row) 
			{
				$data = '';
				if (count($data_attrib)) 
				{
					foreach ($data_attrib as $key) 
					{
						$data .= ' data-'.$key.'="'.$row->$key.'" ';
					}
				}
				$current = ($selected !=null && in_array($row->{$selectField},$selected_idz))?'selected':'';
				
				if (count($merge_fields))  
				{
			        $dropdown_text =  collect($row)->only($merge_fields)->implode($merge_character);
					$select .= '<option '.$current.' '.$data.' value="'.$row->{$selectField}.'">'.$dropdown_text.'</option>';
				}else{
					$select .= '<option '.$current.' '.$data.' value="'.$row->{$selectField}.'">'.$row->{$field_name}.'</option>';
				}

			}
		}else{
			($default)? $select .= '<option value="">--select--</option>':'';
			foreach ($obj as $key => $value) 
			{
				$data = '';
				/*if (count($data_attrib)) 
				{
					foreach ($data_attrib as $key) 
					{
						$data .= ' data-'.$key.'="'.$row->$key.'" ';
					}
				}*/
				$current = ($selected !=null && in_array($key,$selected_idz))?'selected':'';
				$select .= '<option '.$current.' '.$data.' value="'.$key.'">'.$value.'</option>';
			}
		}
		return $select;
	}

}
