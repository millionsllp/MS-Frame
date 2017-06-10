<?php

namespace BECM\MS_Flex\Users;


use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

        
 public function index(){


 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}

public function login(){
   // dd($_SERVER);
	return view('app.B.Modules.MS_Flex.Users.login'); 
}

public function loginPost( Request $R ){

	$input=$R->all();

	$val=\Validator::make($R->all(), [
	 	'UserName'=>'required|exists:MSConfig.MS_Flex_Users,Username',
	 	'Password'=>'required',
	 	]
	 	);

	 if ($val->fails()) {
            return  redirect()->action('\BECM\MS_Flex\Users\Controller@login')
                        ->withErrors($val)
                        ->withInput();
        }

    $model=new Model();

    $row=$model->where('Username',$R->input('UserName'));

    $id=$row->pluck('id');
    $psw=$row->pluck('Password');

    $model2=new Model();    
    $RT=encrypt(str_random(40));

    session(['user' => [
        'RememberToken'=>$RT,
        'id'=>$id->toArray()[0],
        ] ]);

    $row2=$model2->where('id', $id)
            ->update(['RememberToken' => $RT,'LastLogin'=>$_SERVER['REMOTE_ADDR']]);   



    //dd();
    if(!($R->input('Password')===decrypt($psw))){
return  redirect()->action('\BECM\MS_Flex\Users\Controller@login')->with('errors',\collect(['Username/Password invalid.',"Please Enter Valid Username/Password."]));
    }

    return redirect()->action('\BECM\MS_Flex\Panel\Controller@index');

}

public function logout(Request $R){
    $R->session()->forget('user');
    return redirect()->action('\BECM\MS_Flex\Panel\Controller@index');

}

public function panel(){
	dd(session('user'));
	return view('app.B.Modules.MS_Flex.panel'); 

}



}
