<?php

namespace BECM\News\Data;


use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

        
 public function index(){

 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}

public function add(){
	$formData=Base::genFormData();

    $form=\MS\Core\DForm::display($formData);

       $btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\News\Data\Controller@edit',
	    ],

	     [
	    'icon'=>'fa fa-floppy-o',
	    'text'=>'Save',
	    ]
	    ,

    ];
    
    $data=[
    'form-icon'=>'fa fa-newspaper-o',
    'frm-action'=>'\BECM\News\Data\Controller@addPost',
    'form-title'=>'Add or Schedule New News',
    'form-content'=>$form,
    'form-btn'=>$btn,
    'breacrumb'=>[
    			[
    			'text' =>'Home',
    			'actionlink' =>'\BECM\Controller@index',],
    				

    				[
    			'text' =>'Announcements',
    			'actionlink' =>'\BECM\Announcements\Data\Controller@edit',],
    				

    				[
    			'text' =>'Add',
    				],
    				
    				],

    ];
    return view('app.layouts.B.form')->with('data',$data);

}

public function edit(){
	//dd(\Storage::cloud()->get('/News/2017_04_Xehd.jpg'));
	$model=new Model();
	//$list=$model->viewNewsList();
	$list=$model->paginate(15);
	//dd();
	return view('app.B.Modules.News.Edit.index')->with('list',$list);
	//abort(504);
}


public function delete(){
	abort(504);
}

public function addPost(Request $R){
	//dd($R->all());
	$input=$R->all();
	//return response()->json(array('msg'=> ($R->hasfile('Attachments'))), 200);


	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|unique:MSConfig.MS_Flex_News_'.\MS\Core\B::getYr().',UniqId',
	 	'Title'=>'required',
	 	//'LongTitle'=>'required',
	 	//'ShortTitle'=>'required',
	 	'Content'=>'required',
	 	//'Content2'=>'nullable',
	 	//'Content3'=>'nullable',
	 	'Attachments'=>'nullable|file',
	 	]
	 	);

	 if ($val->fails()) {
	 		$status=505;
	 		$array=[
	 		'msg'=>$val->errors()->getMessages(),
	 		];
	 		$json=collect($array)->toJson();
	 		return response()->json($array, $status);
	 		//return $json;

            return  redirect()->action('\BECM\News\Data\Controller@add')
                        ->withErrors($val)
                        ->withInput();
        }

    if($R->hasfile('Attachments')){
		
		$path=$R->Attachments->storeAs('News', str_replace('/','_',$R->input('UniqId')).'.'.$R->Attachments->getClientOriginalExtension(), 'public');
		$input['Attachments']=$path;
		//$input['Attachments']=public_path($input['Attachments']);
	}
	$model=new Model();
	if($model->addNews($input)['status']=='200'){
		$status=200;
		$array=[
	 		'msg'=>$val->errors()->getMessages(),
	 		];
	 		
	}else{
		$status=500;
		$array=[
	 		'msg'=>"Technicle Error Line 87",
	 		];
	 		
	}

	return response()->json($array, $status);
	//abort(504);
}


public function editForm($uniqid){
	$model=new Model();
	$uniqid=Base::decode($uniqid);
	
	$formData=Base::genFormData(true,['UniqId'=>$uniqid]);
    

    $form=\MS\Core\DForm::display($formData);

    //dd( $form);

    $btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\News\Data\Controller@editFormPost',
	    ],

	     [
	    'icon'=>'fa fa-floppy-o',
	    'text'=>'Save',
	    ]
	    ,

	     [
	    'icon'=>'glyphicon glyphicon-trash',
	    'text'=>'Delete',
	    'color'=>'btn-danger',
	    'action'=>'\BECM\News\Data\Controller@deleteGet',
	    'data'=>[
	    		'uniqid'=>Base::enode($uniqid),
	    		],
	    ],
    ];
    
    $data=[
    'form-icon'=>'fa fa-newspaper-o',
    'frm-action'=>'\BECM\News\Data\Controller@editFormPost',
    'form-title'=>'Edit News Unique ID:'.$uniqid,
    'form-content'=>$form,
    'form-btn'=>$btn,
    ];
    return view('app.layouts.B.form')->with('data',$data);



}


public function deleteGet($uniqid){

	$model=new Model();
	$uniqid=Base::decode($uniqid);
	//dd(($model->where('UniqId',$uniqid)->first()==null));

	if($model->where('UniqId',$uniqid)->first()==null)abort(504);
	$model=new Model();
	$input['UniqId']=$uniqid;
	$model->deleteNews($input);
	$btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\News\Data\Controller@edit',
	    ],
	    
    ];
	$data=[
	'msg-title'=>'News Deleted Succefully',
	'msg-content'=>'News Unique ID was: '. $uniqid.'\n Deleted Permenetaly',
	'msg-btn'=>$btn,
	];
	return view('app.layouts.B.msg')->with('data',$data);

}


public function deletePost(Request $R){
	$input=$R->all();
	
	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|exists:MSConfig.MS_Flex_News_'.\MS\Core\B::getYr().',UniqId',
	 	//'Title'=>'required',
	 	//'LongTitle'=>'required',
	 	//'ShortTitle'=>'required',
	 	//'Content'=>'required',
	 	//'Content2'=>'nullable',
	 	//'Content3'=>'nullable',
	 	//'Attachments'=>'nullable|file',
	 	]
	 	);

	if ($val->fails()) {
	 		$status=505;
	 		$array=[
	 		'msg'=>$val->errors()->getMessages(),
	 		];
	 		$json=collect($array)->toJson();
	 		return response()->json($array, $status);
	 		//return $json;

            return  redirect()->action('\BECM\News\Data\Controller@editForm')
                        ->withErrors($val)
                        ->withInput();
        }

      $model=new Model();
	  return $model->deleteNews($input);


}

public function editFormPost(Request $R){
	$input=$R->all();
	//return response()->json(array('msg'=> ($R->hasfile('Attachments'))), 200);


	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|exists:MSConfig.MS_Flex_News_'.\MS\Core\B::getYr().',UniqId',
	 	'Title'=>'required',
	 	//'LongTitle'=>'required',
	 	//'ShortTitle'=>'required',
	 	'Content'=>'required',
	 	//'Content2'=>'nullable',
	 	//'Content3'=>'nullable',
	 	'Attachments'=>'nullable|file',
	 	]
	 	);
	//dd($input);
	 if ($val->fails()) {
	 		$status=505;
	 		$array=[
	 		'msg'=>$val->errors()->getMessages(),
	 		];
	 		$json=collect($array)->toJson();
	 		return response()->json($array, $status);
	 		//return $json;

            return  redirect()->action('\BECM\News\Data\Controller@editForm')
                        ->withErrors($val)
                        ->withInput();
        }

    if($R->hasfile('Attachments')){
		
		$path=$R->Attachments->storeAs('News', str_replace('/','_',$R->input('UniqId')).'.'.$R->Attachments->getClientOriginalExtension(), 'public');
		$input['Attachments']=$path;
		//$input['Attachments']=public_path($input['Attachments']);
	}

	$model=new Model();
	return $model->updateNews($input);


}






}
