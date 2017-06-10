<?php
namespace BECM\FlexBox\BasicDetails;


use \Illuminate\Http\Request;





class Base
{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\BECM\FlexBox\BasicDetails\Controller";
public static $model="\BECM\FlexBox\BasicDetails\Model";

public static $field=[

['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID',],
['name'=>'Name','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Address1','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Address2','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'City','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Pincode','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Number','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Email','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Status','type'=>'string','input'=>'radio','callback'=>'status'],





];
public static $routes=[
[
'name'=>'FlexBox.BasicDetails',
'route'=>'/',
'method'=>'index',
'type'=>'get',
],


// [
// 'name'=>'FlexBox.BasicDetails.View',
// 'route'=>'/View/{id}',
// 'method'=>'view',
// 'type'=>'get',
// ],


// [
// 'name'=>'FlexBox.BasicDetails.Add',
// 'route'=>'/Add',
// 'method'=>'add',
// 'type'=>'get',
// ],

[
'name'=>'FlexBox.BasicDetails.EditGet',
'route'=>'/Edit/{id}',
'method'=>'edit',
'type'=>'get',
],


[
'name'=>'FlexBox.BasicDetails.EditPost',
'route'=>'/Edit/',
'method'=>'editPost',
'type'=>'post',
],

// [
// 'name'=>'FlexBox.BasicDetails.Delete',
// 'route'=>'/Delete',
// 'method'=>'delete',
// 'type'=>'get',
// ],

// [
// 'name'=>'FlexBox.BasicDetails.AddPost',
// 'route'=>'/Add',
// 'method'=>'addPost',
// 'type'=>'post',
// ],

];




public static $table="MS_Flex_FlexBox_BasicDetails";

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

public static function genUniqID(){
	//if($this->where(''))
	return \MS\Core\B::getYr()."/".\MS\Core\B::getMon()."/".str_random(4);
}

public static function status(){
	return [
	'Hide','Display'
	];
}

public static function callbackFunctionName(){
	return "";
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
	return self::$table;
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
			'data'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
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
