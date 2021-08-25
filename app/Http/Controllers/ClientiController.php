<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Customer;

class ClientiController extends Controller
{
    
    
    public function index()
    {
      $client = Customer::get();
 
      
      return view('clienti', [
            'client' => $client
        ]);
      
    }
    
    
}