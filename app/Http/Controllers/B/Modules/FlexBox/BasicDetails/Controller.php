<?php

namespace BECM\FlexBox\BasicDetails;


use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

        
 public function index(){
	$model=new Model();
	$list=$model->viewRowList();
 	return view('app.B.Modules.FlexBox.BasicDetails.index')->with('data',$list);
 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}


public function view($id){
	$model=new Model();
	

	$data=$model->where('id',$id)->get()->first();
 	return view('app.B.Modules.FlexBox.BoardOfDirectors.view')->with('data',$data);
 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}

public function add(){
	$formData=Base::genFormData();

    $form=\MS\Core\DForm::display($formData);

       $btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\FlexBox\BoardOfDirectors\Controller@index',
	    ],

	     [
	    'icon'=>'fa fa-floppy-o',
	    'text'=>'Save',
	    ]
	    ,

    ];
    
    $data=[
    'form-icon'=>'glyphicon glyphicon-user',
    'frm-action'=>'\BECM\FlexBox\BoardOfDirectors\Controller@addPost',
    'form-title'=>'Add New Board of Director',
    'form-content'=>$form,
    'form-btn'=>$btn,
    
    ];
    return view('app.layouts.B.form')->with('data',$data);
}

public function edit($id){
	//dd(\Storage::cloud()->get('/News/2017_04_Xehd.jpg'));
	$model=new Model();
	$data=$model->where('id',$id)->get()->first();
	//return view('app.B.Modules.News.Edit.index')->with('list',$list);
	//dd($model->where('id',$id)->first()->toArray());
	if($model->where('id',$id)->first()==null)abort(504);
	
	$formData=Base::genFormData(true,['id'=>$id]);
    

    $form=\MS\Core\DForm::display($formData);

    //dd( $form);

    $btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\FlexBox\BasicDetails\Controller@index',
	    ],

	     [
	    'icon'=>'fa fa-floppy-o',
	    'text'=>'Save',
	    ]
	    ,

	   
    ];
    
    $data=[
    'form-icon'=>'fa fa-th-list',
    'frm-action'=>'\BECM\FlexBox\BasicDetails\Controller@editPost',
    'form-title'=>'Edit Basic Details : ',
    'form-content'=>$form,
    'form-btn'=>$btn,
    'breacrumb'=>[
    			[
    			'text' =>'Home',
    			'actionlink' =>'\BECM\Controller@index',],
    				

    				[
    			'text' =>'Flex Box',
    			],
    				

    				[
    			'text' =>'Basic Details',
    			'actionlink'=>'\BECM\FlexBox\BasicDetails\Controller@index'
    				],

    				[
    			'text' =>'Edit',
    				],
    				
    				],
    ];
    return view('app.layouts.B.form')->with('data',$data);
	//abort(504);
}


public function editPost(Request $R){
	$input=$R->all();

	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|exists:MSConfig.'.Base::getTable().',UniqId',
		//'Sort'=>'required',
	 	//'Name'=>'required',
	 	//'Photo'=>'nullable|file',
	 	//'AssociationDesignation'=>'required',
	 	//'CurrentDesignation'=>'required',
	 	//'Organization'=>'required',
	 	//'Status'=>'nullable',
	 	//'Number'=>'required',
	 	]
	 	);

	if ($val->fails()) {
	 		$status=505;
	 		$array=[
	 		'msg'=>$val->errors()->getMessages(),
	 		];
	 		$json=collect($array)->toJson();
	 		return response()->json($array, $status);
	 		
        }


	$model=new Model();
	return $model->updateDetails($input);

}


public function delete(){
	abort(504);
}

public function addPost(Request $R){
	//dd($R->all());
	$input=$R->all();
	//return response()->json(array('msg'=> ($R->hasfile('Attachments'))), 200);


	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|unique:MSConfig.'.Base::getTable().',UniqId',
		'Sort'=>'required|unique:MSConfig.'.Base::getTable().',Sort|number',
	 	'Name'=>'required',
	 	'Photo'=>'nullable|file',
	 	'AssociationDesignation'=>'required',
	 	'CurrentDesignation'=>'required',
	 	'Organization'=>'required',
	 	//'Status'=>'nullable',
	 	//'Number'=>'required',
	 	]
	 	);

	 if ($val->fails()) {
	 		$status=505;
	 		$array=[
	 		'msg'=>$val->errors()->getMessages(),
	 		];
	 		$json=collect($array)->toJson();
	 		return response()->json($array, $status);
        }

    if($R->hasfile('Photo')){
		
		$path=$R->Photo->storeAs('BoardOfDirectors', str_replace('/','_',$R->input('UniqId')).'.'.$R->Photo->getClientOriginalExtension(), 'public');
		$input['Photo']=$path;
		//$input['Attachments']=public_path($input['Attachments']);
	}
	$model=new Model();
	if($model->addDirector($input)['status']=='200'){
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
	abort(504);
}







}
