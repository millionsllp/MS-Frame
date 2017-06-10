<?php

namespace BECM\MS_Flex\Panel;


use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

        
 public function index(){

//dd('pal');

return view('app.B.Modules.MS_Flex.panel'); 
 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}



 public function palfun(){

dd('pal');

//return view('app.B.Modules.MS_Flex.panel'); 
 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}


}
