<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Swiper;
use App\Service;

class ServiciiController extends Controller
{
    
    
    public function index()
    {
       $imgs_swiper = Swiper::get();
       $services_data = Service::get();
 
      
     return view('servicii', [
            'imgs_swiper' => $imgs_swiper,
            'services_data' => $services_data
        ]);
      
      
    }
    
    
}