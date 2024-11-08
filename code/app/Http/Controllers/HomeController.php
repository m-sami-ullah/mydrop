<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Package;
use App\Models\Service;
use App\Models\Testimonial;
use EWeLink\Api\Config;
use EWeLink\Api\EWeApi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function login()
    {
        return redirect('administration/login');
    }

    public function home()
    {
        $banners = Banner::enabled()->get();
        $clients = Client::get();
        $services = Service::enabled()->get();
        $faqs = Faq::enabled()->get();
        $testimonials = Testimonial::enabled()->get();
        $packages = Package::with('features')->get();//->enabled()
        return view('home',compact('banners','clients','services','faqs','testimonials','packages'));
    }

    public function device(Request $request)
    {
        $options = [
                'auth' => [
                    'email'    => 'mfaizan1235@gmail.com',
                    'phone'    => '+923135894490', # email or phone login parameter
                    'password' => '22198855',
                    'region'   => 'as'
                ],
                'settings' => [
                    'cachedir' => './cache', // Token cache directory
                    'cachetime' => 3600, // The expiration time, defaults to 3600
                    
                ]
            ];

            // Init configuration
            $config = new Config($options);

            // dd($config);
            // Init API
            // echo '<pre>';
            $api = new EWeApi($config);

            // dump($config,$api);
            // All device

            dump($api->getDevices());

            // One device
            $deviceId = 'a640007143';
            dump( $api->getDevice($deviceId) );

            // $deviceId = '100114b580';
            // $api->toggleDevice($deviceId,2);
            // One device
            dd( $api->getDevice($deviceId) );
    }
}
