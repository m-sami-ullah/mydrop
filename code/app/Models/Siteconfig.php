<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Siteconfig extends Model
{
    use HasFactory;
    use Notifiable;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name','disclaimer','description','phone','email','notify','logo','footerlogo','favicon','watermark','meta_title','meta_description','robots','keywords',
                            'h_trusted',
                            'd_trusted',
                            'h_wedo',
                            'd_wedo',
                            'img1_wedo',
                            'img2_wedo',
                            'h_sol',
                            'd_sol',
                            'img_sol',
                            'h_price',
                            'd_price',
                            'h_faq',
                            'd_faq',
                            'h_about',
                            'd_about',
                            ];


    public function img1()
    {
        
        return empty($this->img1_wedo) ? asset('default/no-image.png'):asset('images/config/'.$this->img1_wedo);
    }
    public function img2()
    {
        
        return empty($this->img2_wedo) ? asset('default/no-image.png'):asset('images/config/'.$this->img2_wedo);
    }
    public function img3()
    {
        
        return empty($this->img_sol) ? asset('default/no-image.png'):asset('images/config/'.$this->img_sol);
    }
    /*public function Footer_Logo()
    {
        
        return empty($this->footerlogo) ? asset('default/footer-logo.png'):asset('images/config/'.$this->footerlogo);
    }*/

    public function Footer_Logo()
    {
        
        return empty($this->footerlogo) ? asset('default/footer-logo.png'):asset('images/config/'.$this->footerlogo);
    }

    public function HeaderLogo()
    {
        
        return empty($this->logo) ? asset('default/logo.svg'):asset('images/config/'.$this->logo);
    }

    public function FaviIcon()
    {
        
        return empty($this->favicon) ? asset('default/favicon.png'):asset('images/config/'.$this->favicon);
    }

    public function water_mark()
    {
        
        return empty($this->watermark) ? asset('default/watermark.png'):asset('images/config/'.$this->watermark);
    }
    
}
