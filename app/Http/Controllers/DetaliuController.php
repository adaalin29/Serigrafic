<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use App\Project;
class DetaliuController extends Controller
{
    
    
    public function index()
    {
      $categorii =Category::select('id','nume_categorie')->get();
      $portofolii = Project::get();
 
      
      return view('detaliu',[
        'categorii' => $categorii,
        'portofolii' => $portofolii,
      ]);
      
      
    }
    
    
}