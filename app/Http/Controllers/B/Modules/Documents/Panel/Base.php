<?php


namespace BECM\MS_Flex\Panel;




class Base
{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\BECM\MS_Flex\Panel\Controller";
public static $model="\BECM\MS_Flex\Panel\Model";

public static $field=[
['name'=>'UniqId','type'=>'string','input'=>'option','callback'=>'genUniqID'],
['name'=>'FirstName','type'=>'string','input'=>'file','callback'=>'callbackFunctionName'],
['name'=>'LastName','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Gender','type'=>'string','input'=>'text','callback'=>'getGender'],
['name'=>'Email','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'MobileNumber','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Username','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Password','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'RememberToken','type'=>'string','input'=>'text','callback'=>'genRemeberToken'],
['name'=>'AccessRole','type'=>'string','input'=>'text','callback'=>'getAccessRole'],
['name'=>'Otp','type'=>'string','input'=>'text','callback'=>'genOTP'],
['name'=>'LastLogin','type'=>'string','input'=>'text','callback'=>'callbackFunctionName'],
['name'=>'Status','type'=>'boolean','input'=>'radio','callback'=>'callbackFunctionName'],



];
public static $routes=[
[
'name'=>'MS_Flex.Panel',
'route'=>'/',
'method'=>'index',
'type'=>'get',
],

];




public static $table="MS_Flex_Users";

public static $connection ="MSConfig";








////////////////////////////////////
/////////////////////////////////////
//MODEL CALLBACK FUNCTIONS///////////
///////////////////////////////////
/////////////////////////////////


public static function callbackFunctionName(){
	return "";
}

public static function genUniqID(){
	return "";
}

public static function getGender(){
	return "";
}

public static function genRemeberToken(){
	return "";
}

public static function getAccessRole(){
	return "";
}

public static function genOTP(){
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
