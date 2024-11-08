<?php

namespace App\Services;

use App\Models\Siteconfig; 
use App\Services\AppService;
use Illuminate\Http\Request; 

class SiteconfigService extends AppService
{
    protected $model;

    public function __construct(Siteconfig $model)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->file_names['image'] = '';
        $this->file_names['footerlogo'] = '';
        $this->file_names['favicon'] = '';
        $this->file_names['watermark'] = '';
        $this->file_names['img1_wedo'] = '';
        $this->file_names['img2_wedo'] = '';
        $this->file_names['img_sol'] = '';
    }

    protected $files = ['image','favicon','footerlogo','watermark','img1_wedo','img2_wedo','img_sol'];
    protected $file_names;
    protected $directory = 'config'; 
    /**
     * set payload data for table.
     * 
     * @param Request $request 
     * @return array of data for saving.
     */
    protected function setDataPayload(Request $request)
    {
        
        $data =  [
            'meta_title'=>$request->meta_title,
            'keywords'=>$request->keywords,
            'meta_description'=>$request->meta_description,
            'robots'=>$request->robots,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'notify'=>'',
            // 'name'=>$request->name,
            // 'description'=>$request->description,
            'slogan'=>$request->slogan,
            'copyright'=>$request->copyright,
            'disclaimer'=>$request->disclaimer,
            'h_trusted'=>$request->h_trusted,
            'd_trusted'=>$request->d_trusted,
            'h_wedo'=>$request->h_wedo,
            'd_wedo'=>$request->d_wedo,
            'h_sol'=>$request->h_sol,
            'd_sol'=>$request->d_sol,
            'h_price'=>$request->h_price,
            'd_price'=>$request->d_price,
            'h_faq'=>$request->h_faq,
            'd_faq'=>$request->d_faq,
            'h_about'=>$request->h_about,
            'd_about'=>$request->d_about,
            ];

        if (!empty($this->file_names['image'])) 
        {
            $data['logo']      =$this->file_names['image'];
        }
        if (!empty($this->file_names['footerlogo'])) 
        {
            $data['footerlogo']      =$this->file_names['footerlogo'];
            
        }
        if (!empty($this->file_names['favicon'])) 
        {
            $data['favicon']   =$this->file_names['favicon'];
        }
        if (!empty($this->file_names['watermark'])) 
        {
            $data['watermark']   =$this->file_names['watermark'];
        }
        if (!empty($this->file_names['img1_wedo'])) 
        {
            $data['img1_wedo']   =$this->file_names['img1_wedo'];
        }
        if (!empty($this->file_names['img2_wedo'])) 
        {
            $data['img2_wedo']   =$this->file_names['img2_wedo'];
        }

        if (!empty($this->file_names['img_sol'])) 
        {
            $data['img_sol']   =$this->file_names['img_sol'];
        }
        
        // dd($data);

        return $data;
    }
 
 


     public function notifications()
    {
        $conf = $this->model::find(1);
        $conf->unreadNotifications->markAsRead();
        return $conf->unreadNotifications;
    }

    // public function markAsRead()
    // {
    //     $conf = $this->model::find(1);
    //     $conf->unreadNotifications->markAsRead();
    // }

}
