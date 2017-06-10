<?php

namespace FECM\AboutUs\Board_of_Directors;




class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

        
 public function index(){
 		//abort(505);
 		return view('app.F.Modules.AboutUs.Board_of_Directors.index'); 


}



}
