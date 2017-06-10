<?php

namespace BECM\FlexBox\CurrentBookVolume;


use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{


 public function __construct()
    {
       
        
        
    }

        
 public function index(){
	$model=new Model();
	$list=$model->viewRowList();
 	return view('app.B.Modules.FlexBox.CurrentBookVolume.index')->with('list',$list);
 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}


public function view($id){
	$model=new Model();
	

	$data=$model->where('id',$id)->get()->first();
 	return view('app.B.Modules.FlexBox.CurrentBookVolume.View')->with('data',$data);
 //return redirect()->action('\BECM\MS_Flex\Users\Controller@login');


}

public function add(){
	$formData=\BECM\News\Data\Base::genFormData();

    $form=\MS\Core\DForm::display($formData);

    return view('app.B.Modules.News.Add.index')->with('form',$form);
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

    $btn=[
	    [
	    'icon'=>'fa fa-arrow-left',
	    'text'=>'Back',
	    'action'=>'\BECM\FlexBox\CurrentBookVolume\Controller@index',
	    ],

	     [
	    'icon'=>'fa fa-floppy-o',
	    'text'=>'Save',
	    ]
	    ,

	  
    ];
    
    $data=[
    'form-icon'=>'fa fa-address-book',
    'frm-action'=>'\BECM\FlexBox\CurrentBookVolume\Controller@editPost',
    'form-title'=>'Edit Unit : '.$data->UnitName,
    'form-content'=>$form,
    'form-btn'=>$btn,
    ];
    return view('app.layouts.B.form')->with('data',$data);
	//abort(504);
}


public function editPost(Request $R){
	$input=$R->all();

	$val=\Validator::make($R->all(), [
		//'UniqId'=>'required|exists:MSConfig.'.Base::getTable().',UniqId',
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
	return $model->updateCurrentVolume($input);}


public function delete(){
	abort(504);
}

public function addPost(Request $R){
	//dd($R->all());
	$input=$R->all();
	//return response()->json(array('msg'=> ($R->hasfile('Attachments'))), 200);


	$val=\Validator::make($R->all(), [
		'UnitName'=>'required|unique:MSConfig.'.Base::getTable().\MS\Core\B::getYr().',UnitName',
	 	'Quantity'=>'required',
	 	//'LongTitle'=>'required',
	 	//'ShortTitle'=>'required',
	 	'QuantityUnit'=>'required',
	 	//'Content2'=>'nullable',
	 	//'Content3'=>'nullable',
	 	'Month'=>'required',
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
	abort(504);
}







}
