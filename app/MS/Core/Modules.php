<?php

namespace MS\Core;


class Modules {


public static function load($baseClass){
$routes=$baseClass::$routes;

foreach ($routes as $value) {
if(!array_key_exists('type', $value))
{

}else{
	//$value['route']=strtolower($value['route']);
	switch ($value['type']) {
		case 'get':
			\Route::get($value['route'],$baseClass::$controller."@".$value['method']);
			break;

		case 'post':
			\Route::post($value['route'],$baseClass::$controller."@".$value['method']);
			break;

		case 'put':
			\Route::put($value['route'],$baseClass::$controller."@".$value['method']);
			break;

		case 'delete':
			\Route::delete($value['route'],$baseClass::$controller."@".$value['method']);
			break;
		
		default:
			# code...
			break;
	}
}
	

	
}

}

}