<?php


namespace FECM\ModuleCode\SubModuleCode1;


class Base
{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $base="\FECM\ModuleCode\SubModuleCode1\Base";
public static $controller="\FECM\ModuleCode\SubModuleCode1\Controller";
public static $model="\FECM\ModuleCode\SubModuleCode1\model";

public static $field=[
['name'=>'name','type'=>'string/boolean','input'=>'text/option/radio/check/password/disable','callback'=>'callbackFunctionName'],

];

public static $routes=[
[
'name'=>'ModuleCode.SubModuleCode1',
'route'=>'/',
'method'=>'methodName',
'type'=>'get/post/put/delete',
],

];



public static $table="TableName_";

public static $connection ="ConnectionName_";








////////////////////////////////////
/////////////////////////////////////
//MODEL CALLBACK FUNCTIONS///////////
///////////////////////////////////
/////////////////////////////////




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
	return self::$table.\MS\Core\B::getMon();
}

public static function getConnection(){
	return self::$connection.\MS\Core\B::getYr();
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
		$table=self::$table.\MS\Core\B::getMon();
		$connection=self::$connection.\MS\Core\B::getYr();
		\MS\Core\B::deleteTable($table,$connection);	
}





public static function genFieldData($data){
	$array=[];
	switch ($data['input']) {
		case 'text':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>'text',
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

		case 'number':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>'number',
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;
		case 'option':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>'option',
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];
			break;

		case 'disable':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>'view',
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];

		case 'radio':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>'view',
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];

		case 'check':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>'view',
			'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			];

		case 'password':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>'view',
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
