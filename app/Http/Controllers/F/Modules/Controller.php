<?php


namespace FECM;


class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

 public function index(){
 		return view('app.F.home'); 
 	}


 	public function underConstruction(){
 		abort(505);
 	}


}
