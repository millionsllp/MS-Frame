<?php
namespace BECM\News\Data;


use \Illuminate\Http\Request;





class Base
{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\BECM\News\Data\Controller";
public static $model="\BECM\News\Data\Model";

public static $field=[
['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID',],
['name'=>'Title','type'=>'string','input'=>'text',],
['name'=>'Content','type'=>'string','input'=>'textarea',],
['name'=>'StartDate','type'=>'string','input'=>'date','callback'=>'toDayDate'],
['name'=>'EndDate','type'=>'string','input'=>'date','callback'=>'afterMonth'],
['name'=>'Attachments','type'=>'string','input'=>'file',],
['name'=>'AddedBy','type'=>'string','input'=>'auto','callback'=>'getUser','hidden'=>true],
['name'=>'Status','type'=>'boolean','input'=>'radio','callback'=>'status'],

];
public static $routes=[
[
'name'=>'News.Data',
'route'=>'/',
'method'=>'index',
'type'=>'get',
],


[
'name'=>'News.Data.Add',
'route'=>'/Add',
'method'=>'add',
'type'=>'get',
],

[
'name'=>'News.Data.Edit',
'route'=>'/Edit',
'method'=>'edit',
'type'=>'get',
],

[
'name'=>'News.Data.Edit.Form',
'route'=>'/Edit/{uniqid}',
'method'=>'editForm',
'type'=>'get',
],

[
'name'=>'News.Data.Edit.Form',
'route'=>'/Edit',
'method'=>'editFormPost',
'type'=>'post',
],


[
'name'=>'News.Data.Delete,Post',
'route'=>'/Delete',
'method'=>'deletePost',
'type'=>'post',
],

[
'name'=>'News.Data.Delete.Get',
'route'=>'/Delete/{uniqid}',
'method'=>'deleteGet',
'type'=>'get',
],

// [
// 'name'=>'News.Data.Delete',
// 'route'=>'/Delete',
// 'method'=>'delete',
// 'type'=>'get',
// ],

[
'name'=>'News.Data.AddPost',
'route'=>'/Add',
'method'=>'addPost',
'type'=>'post',
],

];




public static $table="MS_Flex_News_";

public static $connection ="MSConfig";








////////////////////////////////////
/////////////////////////////////////
//MODEL CALLBACK FUNCTIONS///////////
///////////////////////////////////
/////////////////////////////////


public static function getUser(){

//	$model=new Model();
//	$row=$model->where('id',session('user')['id']);
	return session('user')['id'];

//	return "";
}

public static function status(){
	return [
	'Hide','Publish'
	];
}

public static function callbackFunctionName(){
	return "demo";
}

public static function genUniqID(){
	//if($this->where(''))
	return \MS\Core\B::getYr()."/".\MS\Core\B::getMon()."/".str_random(4);
}

public static function toDayDate(){
	return  \MS\Core\B::getCDate();
}

public static function afterMonth(){
	
	return  \MS\Core\B::getFDate(365);
}

public static function getAccessRole(){
	return "";
}

public static function genOTP(){
	return "";
}


public static function decode($UniqId){
	$UniqId=str_replace('_','/',$UniqId);
	return $UniqId;
}


public static function enode($UniqId){
	$UniqId=str_replace('/','_',$UniqId);
	return $UniqId;
}

//////////////////////////////
//////////////////////////////
//DO NOT EDIT BELOW///////////
////////////////////////////
//////////////////////////

public static function checkDB($name){
if(!(\Storage::disk('masterDB')->exists($name))){
new \SQLite3(database_path('master').DS.$name);
}
}

public static function getTable(){
	return self::$table.\MS\Core\B::getYr();
}

public static function getConnection(){
	return self::$connection;
}

public static function getField(){
	return self::$field;
}



public static  function genFormData($edit=false,$data=[]){
	
	$array=[];
	if($edit and count($data)>0){

		$model=new Model();
		$v=$model->where(array_keys($data)[0],$data[array_keys($data)[0]])->first()->toArray();
		if(count($data)==1){

			foreach (self::$field as $value) {

				//if(array_key_exists('callback', $value))unset($value['callback']);
				$value['value']=$v[$value['name']];
				//$test[]=$value;
				$data=self::genFieldData($value);
				if($data!=null)$array[]=self::genFieldData($value);	
			}
			//return array_keys($data)[0];
			//dd($array);
		}else{

		}

		
		
			
	}else{

		foreach (self::$field as $value) {
		$data=self::genFieldData($value);
		if($data!=null)$array[]=self::genFieldData($value);		
		}
	}

	
	return $array;
}

public static function seed(){
		$table=self::getTable();
		$connection=self::getConnection();
		$field=self::getField();
		//self::checkDB($connection);
		\MS\Core\B::makeTable($table,$field,$connection);
}

public static function rollback(){
		$table=self::getTable();
		$connection=self::getConnection();
		\MS\Core\B::deleteTable($table,$connection);	
}





public static function genFieldData($data){
	$array=[];

	if (array_key_exists('value', $data)) {
		if($data != null){
			$value=$data['value'];
		}
	}

	switch ($data['input']) {
		case 'text':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

		case 'number':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;
		case 'option':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

		case 'disable':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;


		case 'radio':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			'data'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

		case 'check':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

		case 'password':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;


			case 'textarea':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

			case 'auto':
			if(array_key_exists('hidden', $data)){
				if ($data['hidden']) {
					$data['input']='hidden';
				}
			}
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

			case 'date':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

			case 'file':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;
		

		default:
			# code...
			break;
	}

	if(isset($value)){
		$array['value']=$value;
		if($array['value']=='array'){
			$array['value']='';
		}
	}

	$lable=preg_split('/(?=[A-Z])/',ucfirst($data['name']));
	unset($lable[0]);
	(count($lable) >= 2 ? $array['lable']=implode(' ', $lable) : null );

	return $array;
}
public static $d="_";


}
