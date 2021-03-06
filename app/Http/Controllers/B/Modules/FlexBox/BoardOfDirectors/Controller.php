<?php

namespace BECM\FlexBox\BoardOfDirectors;


use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

        
 public function index(){
	$model=new Model();
	$list=$model->viewRowList();
 	return view('app.B.Modules.FlexBox.BoardOfDirectors.index')->with('list',$list);
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

   // dd( $formData);

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

	     [
	    'icon'=>'glyphicon glyphicon-trash',
	    'text'=>'Delete',
	    'color'=>'btn-danger',
	    'action'=>'\BECM\FlexBox\BoardOfDirectors\Controller@deleteGet',
	    'data'=>[
	    		'uniqid'=>Base::enode($formData[0]['value']),
	    		],
	    ],
    ];
    
    $data=[
    'form-icon'=>'fa fa-address-book',
    'frm-action'=>'\BECM\FlexBox\BoardOfDirectors\Controller@editPost',
    'form-title'=>'Edit Board of Director : '.$data->Name,
    'form-content'=>$form,
    'form-btn'=>$btn,
    ];
    return view('app.layouts.B.form')->with('data',$data);
	//abort(504);
}


public function editPost(Request $R){
	$input=$R->all();

	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|exists:MSConfig.'.Base::getTable().',UniqId',
		'Sort'=>'required',
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
	return $model->updateDirector($input);

}


public function delete(){
	abort(504);
}




public function deleteGet($uniqid){

	$model=new Model();
	$uniqid=Base::decode($uniqid);
	//dd(($model->where('UniqId',$uniqid)->first()==null));

	if($model->where('UniqId',$uniqid)->first()==null)abort(504);
	$model=new Model();
	$input['UniqId']=$uniqid;
	$model->deleteDirector($input);
	
	$btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\FlexBox\BoardOfDirectors\Controller@index',
	    ],
	    
    ];

	$data=[
	'msg-title'=>'Board Of Directors Deleted Succefully',
	'msg-content'=>'Board Of Directors Unique ID was: '. $uniqid.' Deleted Permenetaly',
	'msg-btn'=>$btn,
	];
	return view('app.layouts.B.msg')->with('data',$data);

}




public function addPost(Request $R){
	//dd($R->all());
	$input=$R->all();
	//return response()->json(array('msg'=> ($R->hasfile('Attachments'))), 200);


	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|unique:MSConfig.'.Base::getTable().',UniqId',
		'Sort'=>'required|unique:MSConfig.'.Base::getTable().',Sort',
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
	}else{
		$input['Photo']='img/data/User-icon.png';
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
