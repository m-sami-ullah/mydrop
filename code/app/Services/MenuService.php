<?php

namespace App\Services;

use App\Models\Menu; 
use App\Services\AppService;
use Illuminate\Http\Request; 
use Illuminate\Support\Str;
use DB;
class MenuService extends AppService
{
    protected $model;
    public $parent = '';
    public $url;
    public $active;
    public $collapseStyle;
    public $isCollapse;
    public $menu;
    public $categories;
    public $product;
    public $type;
    public $iCatagoryID;

    public $ulClass;
    public $liClass;
    public $caret;
    public $nav_id;


    public function __construct(Menu $model)
    {
        parent::__construct($model);
        $this->model = $model;

        $this->active        = ' in ';
        $this->collapseStyle = ' style="height: auto;" ';
        $this->isCollapse = '';
        $this->ulClass       = 'nav navbar-nav custmnav';
        $this->liClass       = 'dropdown';

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        $status = $request->status==1 ? 1:0;
        
         $data = array(
                        'title'=>$request->title,
                        'sortorder'=>$request->sortorder, 
                        'url'=> $request->url,
                        'type'=> $request->type,
                        'nav_id'=> $request->nav_id,
                        'status'=>$status,
                        'parent'=>null
                    );
        return $data;
    }

    
    
    public function addPage($request,$nav_id)
    {
        $pages = $request->pages;
        // dd($request->all());
        if (count(array_filter($pages)) !=0 ) 
        {
            $i = 1;
            $parent_menu =  $this->model->where('nav_id',$nav_id)->where('parent',null)->orderBy('sortorder','desc')->limit(1)->first();

            
            if ($parent_menu) 
            {
                $i = $parent_menu->sortorder;
            }

            foreach ($pages as $key=>$slug) 
            {
                $request->merge($request->input('page.'.$key));
                 
                $request->merge(['sortorder'=>$i]);
                
                $request->merge(['url'=>urldecode($request->url)]);
     
                $record = $this->model->create($this->setDataPayload($request));
                // $this->store($record,$request);
            }

            return true;
        }
        return false;
    }

    public function addcustom($request,$nav_id)
    {
        $i = 1;
        $parent_menu =  $this->model->where('nav_id',$nav_id)->where('parent',null)->orderBy('sortorder','desc')->limit(1)->first();

        
        if ($parent_menu) 
        {
            $i = $parent_menu->sortorder;
        }
        $request->merge(['sortorder'=>$i]);
        $request->merge(['nav_id'=>$nav_id]);
        
        $record = $this->model->create($this->setDataPayload($request));
        // $this->store($request);
        
        return true;
    }

    public function addCategory($request,$nav_id)
    {
        $categories = $request->categories;
        if (count(array_filter($categories)) !=0 ) 
        {
            $i = 1;
            $parent_menu =  $this->model->where('nav_id',$nav_id)->where('parent',null)->orderBy('sortorder','desc')->limit(1)->first();

            
            if ($parent_menu) 
            {
                $i = $parent_menu->sortorder;
            }

            
            foreach ($categories as $key=>$slug) 
            {
                $request->merge($request->input('category.'.$key));
                $request->merge(['sortorder'=>$i]);
                $request->merge(['url'=>urldecode($request->url)]);
                
                $record = $this->model->create($this->setDataPayload($request));
                $this->store($record,$request);

                /*$request->merge($request->input('category.'.$key));
                $category = $request->input('category.'.$key);
                
                $category['sortorder'] = $i;
                $category = new \Illuminate\Http\Request($category);
                
                $record = $this->store($category);
                $this->store($record,$category);*/
            }

            return true;
        }
        return false;
    }

    public function edit($nav,$request)
    {
        // $nav->update(['sortorder'=>$order,'parent'=>$parent]);
        $this->update($nav,$request);
    }

    public function editmenu($nav,$request)
    {
        // dd($request->all(),$nav);
        $links = $request->menuOrder;
        $links = json_decode($links);
        $i=0;
        foreach ($links as $idz) 
        {
            $mnID = $idz->id;

            $menu = $this->model->find($mnID);

            $i++;
            $this->updateMenuDetail($request,$menu,$i,NULL);
            if(property_exists($idz,'children'))
            {
                $this->getCMenu($request,$idz->children,$mnID);
            }
            
        }

        // dd();
    }



    public function getCMenu($request,$c_links,$parentID)
    {
        $j = 1;
        

        foreach ($c_links as $iddz) 
        {
            $mnID = $iddz->id;

            $menu = $this->model->find($mnID);

            $this->updateMenuDetail($request,$menu,$j++,$parentID);
            if(property_exists($iddz,'children'))
            {
                $this->getCMenu($request,$iddz->children,$mnID);
            }
            
        }
    }

    public function updateMenuDetail($request,$menu,$order,$parent)
    {
        $mtype = $request->mtype;
        $mlabel = $request->label;

        $mlabel = $mlabel[$menu->id];
        $mtype = $mtype[$menu->id];

        $mlabel = new \Illuminate\Http\Request($mlabel);
        $request->merge($request->input('label.'.$menu->id));

        if ($mtype==3) 
        {
            $url = array_key_exists($menu->id,$request->custom) ?  $request->custom[$menu->id] : '';
            $menu->update(['sortorder'=>$order,'parent'=>$parent,'url'=>$url]);
        }else{
            $menu->update(['sortorder'=>$order,'parent'=>$parent]);
            // dd($menu);

        } 
            // $this->update($menu,$request);


    }
    public function save($request)
    {
        $value = $request->input('name.en');
        $slug = Str::slug($value, '-');

        $record = $this->store($request);
        $record->slug = $slug . $record->id;
        $record->save();
        $this->store($record,$request);

        return $record;
    }



    public function getMenu($nav_id)
    {
        $this->nav_id = $nav_id;
        $this->menu = '';

        $parent_menu =  $this->model->where('parent',null)->where('nav_id',$nav_id)->orderBy('sortorder','asc')->get();
        if ($parent_menu->count()) 
        {
            $this->returnMenu($parent_menu);
        }

        return $this->menu;
        
    }
    public function getChildmenu()
    {
        $child_menu =  $this->model->where('parent',$this->id)->orderBy('sortorder','asc')->get();
        if ($child_menu->count()) 
        {
            $this->returnMenu($child_menu);
        }else{
            return ;
        }
    }
    public function returnMenu($gm)
    {
        $this->menu  .= $this->ol_start();
            foreach ($gm as $mRow) 
            {
                $this->id = $mRow->id;
                $this->parent = $mRow->parent;
                $this->url = $mRow->url;
                $this->title = $mRow->title;
                $this->type = $mRow->type;
                if ($this->type==1) {
                    $this->type_title = 'Category';
                }elseif($this->type==2) {
                    $this->type_title = 'Page';
                }elseif($this->type==3) {
                    $this->type_title = 'Custom';
                }elseif($this->type==4) {
                    $this->type_title = 'Subcategories';
                }
                $this->menu .= $this->li_start();
                $this->menu .= $this->Mhead();
                $this->menu .= $this->Collapse_start();
                switch ($mRow->type) 
                {
                    case 1:
                        $this->menu .= $this->CategoryType($mRow);
                        break;
                    case 2:
                        $this->menu .= $this->PageType($mRow);
                        break;
                    case 3:
                        $this->menu .= $this->CustomType($mRow);
                        break;
                    case 4:
                        $this->menu .= $this->SubcategoryType($mRow);
                        break;
                    
                    default:
                        break;
                }

                $this->menu .= $this->Collapse_end();

                
                $this->active = '';
                $this->isCollapse = ' collapsed ';
                $this->collapseStyle = 'style="height: 0;"';

                $this->getChildmenu();
                

                $this->menu .= $this->li_end();
            }
            $this->menu  .= $this->ol_end();

            return $this->menu;
    }

    public function li_start()
    {
        return '<li class="dd-item dd3-item" data-id="'.$this->id.'">';
    }
    public function liStart()
    {
        return '<li>';
    }
    public function ol_start()
    {
        return '<ol class="dd-list">';
    }
    public function ul_start()
    {
        return '<ul class="list-unstyled">';
    }
    public function li_end()
    {
        return '</li>';
    }
    public function liEnd()
    {
        return '</li>';
    }
    public function ol_end()
    {
        return '</ol>';
    }
    public function ul_end()
    {
        return '</ul>';
    }
    public function Mhead()
    {
        $list =     '<div class="dd-handle dd3-handle"></div>';
        $list .=    '<div class="dd3-content title-container">';
        $list .=    '<div class=" pull-left">'; 
        $list .=        $this->title;
        $list .=    '</div>';
        $list .=    '<div class="pull-right  " >';
        $list .=    '<span class="item_type" >'.$this->type_title.'</span>';
        $list .=        '<a class=" toggle-container accordion-toggle accordion-toggle-styled '.$this->isCollapse.'"    data-toggle="collapse" data-parent="#nestable_list_3" href="#collapse_'.$this->parent.'_'.$this->id.'">';
        $list .=        '</a>';
        $list .=    '</div>';
        $list .=    '</div>';

        return $list;
    }

    public function Collapse_start()
    {
        $list =     '<div class="panel panel-default panel-custom">';
        $list .=    '<div id="collapse_'.$this->parent.'_'.$this->id.'" class="panel-collapse collapse '.$this->active.'" '.$this->collapseStyle.'>';
        $list .=    '<div class="panel-body ">';

        return $list;
    }

    public function Collapse_end()
    {
     

        $list =     '<div class="action-container mt-1">
                        <a class="btn btn-danger btn-xs" href="'.route('menu.links.delete',['nav'=>$this->nav_id,'menu'=>$this->id]).'">Remove</a> | <a class="accordion-toggle'.$this->isCollapse.'" data-toggle="collapse" data-parent="#nestable_list_3" href="#collapse_'.$this->parent.'_'.$this->id.'">Cancel</a>
                    </div>';
        $list .=    '</div>';
        $list .=    '</div>';
        $list .=    '</div>';

        return $list;
    }
    public function CustomType($row)//3
    {

        $list =     '<div class="">';
        $list .=        '<label class="control-label">Url</label>';
        $list .=        '<input type="url" id="" name="custom['.$this->id.']" class="form-control" value="'.$this->url.'" placeholder="Url">';
        $list .=    '</div>';

        // $list = '';
        // foreach ($row->translation as $trow) 
        // {
            $list .=     '<div class="">';
            $list .=        '<label class="control-label">Label </label>';
            
            $list .=        '<input type="text"  id="mlabel['.$this->id.']" name="label['.$this->id.'][title]" class="form-control" value="'.$row->title.'"  placeholder="">';
            $list .=    '</div>';
        // }

        $list .= '<input type="hidden"  id="mtype['.$this->id.']" name="mtype['.$this->id.']" class="form-control" value="'.$this->type.'">';
        

        return $list;
    }
    public function PageType($row)//2 
    {

        $list = '';
        // foreach ($row->translation as $trow) 
        {
            $list .=     '<div class="">';
            $list .=        '<label class="control-label">Label </label>';
            
            $list .=        '<input type="text"  id="mlabel['.$this->id.']" name="label['.$this->id.'][title]" class="form-control" value="'.$row->title.'"  placeholder="">';
            $list .=    '</div>';
        }

        $list .= '<input type="hidden"  id="mtype['.$this->id.']" name="mtype['.$this->id.']" class="form-control" value="'.$this->type.'">';

        // $list .=    '</div>';

        return $list;
    }
    public function CategoryType($row)//1
    {

        $list = '';
        // foreach ($row->translation as $trow) 
        {
            $list .=     '<div class="">';
            $list .=        '<label class="control-label">Label </label>';
            
            $list .=        '<input type="text"  id="mlabel['.$this->id.']" name="label['.$this->id.'][title]" class="form-control" value="'.$row->title.'"  placeholder="">';
            $list .=    '</div>';
        }

        $list .= '<input type="hidden"  id="mtype['.$this->id.']" name="mtype['.$this->id.']" class="form-control" value="'.$this->type.'">';

        return $list;
    }
    public function SubcategoryType($row)//4 
    {

       $list = '';
        // foreach ($row->translation as $trow) 
        {
            $list .=     '<div class="">';
            $list .=        '<label class="control-label">Label </label>';
            
            $list .=        '<input type="text"  id="mlabel['.$this->id.']" name="label['.$this->id.'][title]" class="form-control" value="'.$row->title.'"  placeholder="">';
            $list .=    '</div>';
        }

        $list .= '<input type="hidden"  id="mtype['.$this->id.']" name="mtype['.$this->id.']" class="form-control" value="'.$this->type.'">';
        

        return $list;
    }

    
    public function delete_menu($request,$nav_id,$menu)
    {

        $parent = $menu->parent;
        $newParent = $menu->parent;
        if (!empty($parent)) 
        {
            
            $giC = $this->model->where('nav_id',$nav_id)->where('parent',$menu->id)->get();
            if ($giC->count()) 
            {
                // if item have childs so get item's nearest Sibbling 
                // then change childs parent's to sibbling id
                // if no sibling then change childs parent to item parent
            

                $gNSib = $this->model->where('nav_id',$nav_id)->where('id','!=',$menu->id)->where('parent',$parent)->orderBy('sortorder','desc')->limit(1)->first();
                if ($gNSib) 
                {
                    $newParent = $gNSib->id; 
                }
                $data['parent'] = $newParent;

                $this->model->where('nav_id',$nav_id)->where('parent',$menu->id)->update($data);

                // $menu->translation()->delete();
                $menu->delete();

            }else{
                // no childs so delete item
                // $menu->translation()->delete();
                $menu->delete();
            }
        }else
        {

            $giC = $this->model->where('nav_id',$nav_id)->where('parent',$menu->id)->get();
            if ($giC->count()) 
            {
                $data['parent'] = NULL;
                $this->model->where('nav_id',$nav_id)->where('parent',$menu->id)->update($data);
            }
            // $menu->translation()->delete();
            $menu->delete();
        }

        return true;;
    }


     
}
