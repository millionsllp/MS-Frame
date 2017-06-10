<?php

namespace FECM\AboutUs\Massage;




class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

    
        
public function index(){
		abort(505);
 		return view('app.F.Modules.AboutUs.Massage.index'); 
}


}
