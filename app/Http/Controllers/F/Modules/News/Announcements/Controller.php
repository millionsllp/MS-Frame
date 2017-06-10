<?php

namespace FECM\News\Announcements;




class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
    $this->table=new \BECM\Announcements\Data\Model ();
    
        
    }

 public function index(){
 	//$data=$this->table->where('Status', '1')->orderBy('StartDate', 'desc')->get()->toArray();
 	$date=date('Y-m-d');

 	


 	$data=$this->table->where('Status', '1')->where('EndDate','>',$date)->where('StartDate','<=',$date)->orderBy('StartDate', 'desc')->orderBy('created_at', 'desc')->paginate(5);
 	//dd($this->table->where('Status', '1')->where('StartDate','<=',$date)->get()->toArray());
 	//;
 	return view('app.F.Modules.News.Announcements.index')->with('data',$data); 	
 }
 public function view($uniqId){
 	$date=date('Y-m-d');
 	$uniqId=str_replace('_', '/', $uniqId);
 	$data=$this->table->where('Status', '1')->where('EndDate','>',$date)->where('StartDate','<=',$date)->where('UniqId',$uniqId)->first();
 	
 	if(!($data==null)){
 	return view('app.F.Modules.News.Announcements.view')->with('data',$data); 	
 	}
 	abort(404);
 	
 }

}

