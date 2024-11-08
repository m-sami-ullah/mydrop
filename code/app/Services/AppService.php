<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Helper\Filemgr;
use App\Helper\Functions;
class AppService
{
     /**
     * Eloquent model instance.
     */
    protected $model;
    protected $limit = 10;
    protected $guard = 'web';
    protected $files =[];
    protected $file_names =[];

    protected $directory = 'media';
    /**
     * load default class dependencies.
     * 
     * @param Model $model Illuminate\Database\Eloquent\Model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function __call($method,$parameters)
    {
        
        $this->model->__call($method, $parameters);
        return $this;
    }
    public function getstatic($variable='')
    {
        return ($variable!='' && property_exists($this->model,$variable) ) ? $this->model::$$variable : '';
    }
    public function getconst($variable='')
    {
        $class = get_class($this->model);
        return $const = constant("$class::$variable");
        return ($variable!='' && defined("$const") ) ? $const : '';
    }
    public function collection($data,$Resource=NULL)
    {
        $Collection_Namespace = '\\App\\Http\\Resources\\collection\\';
        $ResourceName         = $Resource==NULL ? $this->modelName() : $Resource ;
        $ResourceName         = $ResourceName.'Collection';
        $Collection           = $Collection_Namespace.$ResourceName;
        return (class_exists($Collection)) ?  new $Collection($data) : $data ;
    }

    public function resource($data,$Resource=NULL)
    {
        $Resources_Namespace = 'App\\Http\\Resources\\';
        $ResourceName         = $Resource==NULL ? $this->modelName() : $Resource ;
        
        $Resources           = $Resources_Namespace.$ResourceName;
        return (class_exists($Resources)) ?  new $Resources($data) : $data ;
    }


    public function all(Request $request)
    {
        $fillable = $this->model->getFillable();
        $filters = $request->only($fillable);

        if (count($filters)!=0) 
        {
             return $this->model
                                ->where($filters)
                
                                // ->orWhere($orWhere)
                                ->get();
                                
        }else
        {
            return $this->model->get();
        }
    }

    public function byid($id)
    {
        if ($id) 
        {
            return $this->model->find($id);
        }
        return null;
    }
    

    /**
     * get all the items collection from database table using model.
     * 
     * @return Collection of items.
     */
    /*public function dropdown($obj,$selected=null,$fields=['id','name'],$default=true,$data_attrib=[])
    {
        return Functions::select($obj,$fields=['id','name'],$selected,$default,$data_attrib);
    }*/
    public function dropdown($obj,$selected=null,$fields=['id','name'],$default=true,$data_attrib=[],$merge_fields=[],$merge_character='')
    {
        
        return Functions::select($obj,$fields,$selected,$default,$data_attrib,$merge_fields,$merge_character);
    }

    /**
     * get collection of items in paginate format.
     * 
     * @return Collection of items.
     */
    public function paginate(Request $request)
    {
        
        $query = $this->filters($request);

        if ($request->has('pagination') && $request->pagination=='no') 
        {
            
            return $query = $query->get();
        }else
        {
            return $query = $query->paginate($request->input('limit', $this->limit));
        }
    }

    /**
     * get all the items collection from database table using model.
     * 
     * @return Collection of items.
     */
    public function get($request=null)
    {
        if ($request) 
        {
            
            $query = $this->filters($request);
            return $query->get();
        }else
        {

            return $this->model->get();
        }
    }


    public function filters($request)
    {
        $orderBy = [];

        $fillable = $this->model->getFillable();
        $fillable[] = 'id';
        $filters = $request->only($fillable);
        $query = $this->model->query();

        
        if ($request->has('orderBy')) 
        {
            $order_by_array = explode(',',$request->orderBy);
            if (count($order_by_array)) 
            {
                $orderBy = array_chunk($order_by_array, 2);
                // $orderBy = $request->orderBy;
            }
        }

        if (count($filters)!=0) 
        {
            $query = $query->where($filters);
        }

        if (is_array($orderBy) && count($orderBy)!=0) 
        {
            foreach ($orderBy as $pair) 
            {
                if (array_key_exists(1, $pair) && in_array($pair[1], ['asc','desc']) && in_array($pair[0],$fillable)) 
                {
                    $query->orderBy(...$pair);
                    
                }
                // Use the 'splat' to turn the pair into two arguments
            }
        }
        return $query;
    }

    public function fileupload($item=NULL)
    {
        
        if (count($this->files)) 
        {

            foreach ($this->files as $file) 
            {
                $upload = Filemgr::uploadFile($file,$this->directory);
                if ($upload['success']) 
                {
                    if ($item) 
                    {

                        // Filemgr::deletefile($item->{$file},$this->directory);          
                    }
                    $this->file_names[$file] = $upload['filename'];
                }
            }
        }

    }

    public function deletefile($item)
    {
        if (count($this->files)) 
        {

            foreach ($this->files as $file) 
            {
                if ($item) 
                {
                    Filemgr::deletefile($item->{$file},$this->directory);          
                }
            }
        }
    }
    /**
     * create new record in database.
     * 
     * @param Request $request Illuminate\Http\Request
     * @return saved model object with data.
     */
    public function store(Request $request)
    {
        
        $this->fileupload();
        $data = $this->setDataPayload($request);
        $item = $this->model;
        $item->fill($data);
        $item->save();
        return $item;
    }

    public function manytomany($record,$many_function_name,$request_array,$pivotFields=null)
    {
        $pivotData         = array_fill(0, count($request_array), $pivotFields);
        $many_data_array  = array_combine($request_array, $pivotData);
        $record->{$many_function_name}()->sync($many_data_array);
    }

 
    
    /**
     * update existing item.
     * 
     * @param  Integer $id integer item primary key.
     * @param Request $request Illuminate\Http\Request
     * @return send updated item object.
     */
    public function update($item,Request $reqest)
    {
        $request = request();
        $this->fileupload($item);
        $data = $this->setDataPayload($request);
        // remove file index/key from data if user not upload any file
        if ($this->file_names) 
        {
            foreach ($this->file_names as $key => $value) 
            {
                if (empty($value)) 
                {
                    unset($data[$key]);
                }
            }
        }
        // $item = $this->model->findOrFail($id);
        $item->fill($data);
        $item->save();
        return $item;
    }
    /**
     * get requested item and send back.
     * 
     * @param  Integer $id: integer primary key value.
     * @return send requested item data.
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
    /**
     * Delete item by primary key id.
     * 
     * @param  Integer $id integer of primary key id.
     * @return boolean
     */
    public function delete($item)
    {
        $this->deletefile($item);
        return $item->delete();
        // return $this->model->destroy($id);
    }
    /**
     * set data for saving
     * 
     * @param  Request $request Illuminate\Http\Request
     * @return array of data.
     */
    protected function setDataPayload(Request $request)
    {

        // return $request->validated();
        return $request->all();
    } 

    public function deleteall(Request $request,$keys = 'actionbtn')
    {
        if ($request->has($keys) && count($request->{$keys})>0) 
        {
            $this->model->whereIn('id',$request->{$keys})->delete();
        } 
    }

    public function addMsg($module_name=NULL)
    {

        $module_name = $module_name==null ? $this->get_model_name() : $module_name;
        return __('crud.added',['module'=>$module_name]);
    }

    public function updateMsg($module_name=NULL)
    {
        $module_name = $module_name==null ? $this->get_model_name() : $module_name;
        return __('crud.updated',['module'=>$module_name]);
    }

    public function delMsg($module_name=NULL)
    {
        $module_name = $module_name==null ? $this->get_model_name() : $module_name;
        return __('crud.deleted',['module'=>$module_name]);
    }

    public function Msg($msg=NULL)
    {
        return __('lang.'.$msg);
    }


    protected function get_model_name()
    {
        $model_name = property_exists($this->model,'module_name') ? $this->model->module_name :$this->modelName();
        return $model_name;
    }

    protected function modelName()
    {
        $model_class_name =explode('\\', get_class($this->model)) ;
        $model_class_name = end($model_class_name);
        return $model_class_name;
    }

    public function dbException($exception)
    {
        $Msg = $exception->getMessage();
        if ($exception->getCode()==23000) 
           {
               $Msg = 'Cannot delete or update a foreign key constraint record.';
           }
        return $Msg;
    }

     
}
