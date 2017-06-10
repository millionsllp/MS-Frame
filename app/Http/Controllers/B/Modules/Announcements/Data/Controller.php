<?php

namespace BECM\Announcements\Data;


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
	    'action'=>'\BECM\Announcements\Data\Controller@edit',
	    ],

	     [
	    'icon'=>'fa fa-floppy-o',
	    'text'=>'Save',
	    ]
	    ,

    ];
    
    $data=[
    'form-icon'=>'fa fa-bullhorn',
    'frm-action'=>'\BECM\Announcements\Data\Controller@addPost',
    'form-title'=>'Add or Schedule New Announcements',
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
	//dd($list->toArray());
	return view('app.B.Modules.Announcements.index')->with('list',$list);
	//abort(504);
}


public function delete(){
	abort(504);
}

public function addPost(Request $R){
	//dd($R->all());
	$input=$R->all();
	//return response()->json(array('msg'=> ($R->hasfile('Attachments'))), 200);

	//dd($input);
	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|unique:MSConfig.MS_Flex_Announcements_'.\MS\Core\B::getYr().',UniqId',
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

            return  redirect()->action('\BECM\Announcements\Data\Controller@add')
                        ->withErrors($val)
                        ->withInput();
        }

    if($R->hasfile('Attachments')){
		
		$path=$R->Attachments->storeAs('Announcements', str_replace('/','_',$R->input('UniqId')).'.'.$R->Attachments->getClientOriginalExtension(), 'public');
		$input['Attachments']=$path;
		//$input['Attachments']=public_path($input['Attachments']);
	}
	$model=new Model();
	if($model->MSaddRow($input)['status']=='200'){
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
	$data=$model->where('UniqId',$uniqid)->get()->first();
	//return view('app.B.Modules.News.Edit.index')->with('list',$list);
	//dd($model->where('id',$id)->first()->toArray());
	if($model->where('UniqId',$uniqid)->first()==null)abort(504);
	
	$formData=Base::genFormData(true,['UniqId'=>$uniqid]);
    

    $form=\MS\Core\DForm::display($formData);

    //dd( $form);

    $btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\Announcements\Data\Controller@edit',
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
	    'action'=>'\BECM\Announcements\Data\Controller@deleteGet',
	    'data'=>[
	    		'uniqid'=>Base::enode($uniqid),
	    		],
	    ],
    ];
    
    $data=[
    'form-icon'=>'fa fa-address-book',
    'frm-action'=>'\BECM\Announcements\Data\Controller@editFormPost',
    'form-title'=>'Edit Board of Director : '.$data->Name,
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
	$model->MSdeleteRow($input);

	$btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\Announcements\Data\Controller@edit',
	    ],
	    
    ];

	$data=[
	'msg-title'=>'Announcements Deleted Succefully',
	'msg-content'=>'Announcements Unique ID was: '. $uniqid.' Deleted Permenetaly',
	'msg-btn'=>$btn,
	];
	return view('app.layouts.B.msg')->with('data',$data);

}


public function deletePost(Request $R){
	$input=$R->all();
	
	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|exists:MSConfig.MS_Flex_Announcements_'.\MS\Core\B::getYr().',UniqId',
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

            return  redirect()->action('\BECM\Announcements\Data\Controller@editForm')
                        ->withErrors($val)
                        ->withInput();
        }

      $model=new Model();
	  return $model->MSdeleteRow($input);


}

public function editFormPost(Request $R){
	$input=$R->all();
	//return response()->json(array('msg'=> ($R->hasfile('Attachments'))), 200);


	$val=\Validator::make($R->all(), [
		'UniqId'=>'required|exists:MSConfig.MS_Flex_Announcements_'.\MS\Core\B::getYr().',UniqId',
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

            return  redirect()->action('\BECM\Announcements\Data\Controller@editForm')
                        ->withErrors($val)
                        ->withInput();
        }

    if($R->hasfile('Attachments')){
		
		$path=$R->Attachments->storeAs('Announcements', str_replace('/','_',$R->input('UniqId')).'.'.$R->Attachments->getClientOriginalExtension(), 'public');
		$input['Attachments']=$path;
		//$input['Attachments']=public_path($input['Attachments']);
	}

	$model=new Model();
	return $model->MSupdateRow($input);


}






}
