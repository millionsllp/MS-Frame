<?php


namespace BECM;

//use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

 public function index(Request $request){
 			
 		

 		return redirect()->action('\BECM\MS_Flex\Panel\Controller@index');

 		//dd($ms_users);
 		//return view('app.B.Modules.MS_Flex.Users.login'); 
 		//return view('app.B.home'); 
 	}


}
