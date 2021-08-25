<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use App\Project;

class PortofoliuController extends Controller
{
    
    
    public function index()
    {
      $categorii =Category::select('id','nume_categorie')->get();
      $portofolii = Project::get();
      
      foreach($portofolii as &$album){
        $album->images = json_decode($album->images);
      }
      // dd($portofolii->toArray());
      
      return view('portofoliu',[
        'categorii' => $categorii,
        'portofolii' => $portofolii,
      ]);
      
      
    }
    // nu o sa mai folosesc ptr ca am galerie pe pagina asta
  public function detaliu_portofoliu($url){
     {
      $portofoliu = Project::where('slug', $url)->firstOrFail();
      return view('detaliu',[
        'portofoliu' => $portofoliu
      ]);
      
    }
    
  }
    
    
}