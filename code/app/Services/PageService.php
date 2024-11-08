<?php

namespace App\Services;

use App\Models\Page;
use App\Services\AppService;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class PageService extends AppService
{
    protected $model;
			protected $file_names;
			protected $directory = "page";
			protected $files = ["image"];

    public function __construct(Page $model)
    {
        parent::__construct($model);
        $this->model = $model;
			$this->file_names["image"]="";

    }

    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
			$id = $request->page ? $request->page->id : NULL;
			$payload = [
						"name"=> $request->name,
                        "slug"=> Str::slug($request->slug),
						"description"=> $request->description,
						"short_description"=> $request->short_description,
						"image" => $this->file_names["image"],
						"meta_title"=> $request->meta_title,
						"keywords"=> $request->keywords,
						"meta_description"=> $request->meta_description,
						"robots"=> $request->robots,
						"status"=> $request->status,
			];
			return $payload; 

    }
    
     
 
    public function bySlug($slug)
    {
        return $this->model->where('slug',$slug)->firstOrFail();
    }
    
    
    public function savecontact($request)
    {
        
        $site_conf = Siteconfig::find(1);
        Notification::send($site_conf, new Contactus($request));

        Notification::route('mail', $request->email)->notify(new Contactusreply($request->name));
        
        
    }

    
    

}
