<?php


namespace FECM\AboutUs\Board_of_Directors;




class Base
{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\FECM\AboutUs\Board_of_Directors\Controller";
public static $model="\FECM\AboutUs\Board_of_Directors\Model";

public static $field=[
['name'=>'Sort','type'=>'string','input'=>'option','callback'=>'callbackFunctionName'],
['name'=>'Photo','type'=>'string','input'=>'file','callback'=>'callbackFunctionName'],
['name'=>'Name','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'AssociationDesignation','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'CurrentDesignation','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Organization','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Email','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Status','type'=>'boolean','input'=>'radio','callback'=>'callbackFunctionName'],



];
public static $routes=[
[
'name'=>'AboutUs.Board_of_Directors',
'route'=>'/',
'method'=>'index',
'type'=>'get',
],];




public static $table="BoardOfDirectors";

public static $connection ="MSConfig";








////////////////////////////////////
/////////////////////////////////////
//MODEL CALLBACK FUNCTIONS///////////
///////////////////////////////////
/////////////////////////////////


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

static public function genFormData(){
	
	$array=[];
	foreach (self::$field as $value) {
		$data=self::genFieldData($value);
		if($data!=null)$array[]=self::genFieldData($value);		
		
	}
	return $array;
}

public static function seed(){
		$table=self::getTable();
		$connection=self::getConnection();
		$field=self::getField();
		self::checkDB($connection);
		\MS\Core\B::makeTable($table,$field,$connection);
}

public static function rollback(){
		$table=self::getTable();
		$connection=self::getConnection();
		\MS\Core\B::deleteTable($table,$connection);	
}





public static function genFieldData($data){
	$array=[];
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

		case 'radio':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];

		case 'check':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];

		case 'password':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
		

		default:
			# code...
			break;
	}

	$lable=preg_split('/(?=[A-Z])/',ucfirst($data['name']));
	unset($lable[0]);
	(count($lable) >= 2 ? $array['lable']=implode(' ', $lable) : null );

	return $array;
}
public static $d="_";


}
