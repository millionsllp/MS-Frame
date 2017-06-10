<?php

namespace MS\Core;




class MSDB {


public static function findDuplicate($class,$cloumn,$value){


	$row=$class->where($cloumn,$value)->get()->toArray();
	//dd($row);
	//dd();

	if(collect($row)->isNotEmpty()){
		return ['error'=>true,'msg'=>"Duplicate Found"];
	}

	return ['error'=>false,'msg'=>"Duplicate Not Found"];

}


}