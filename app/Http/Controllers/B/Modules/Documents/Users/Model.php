<?php

namespace BECM\MS_Flex\Users;


class Model extends \Illuminate\Database\Eloquent\Model
{

protected $table;
protected $connection;
protected $fillable;
protected	$base_Field;

	public function __construct()
    {
        $this->table=Base::getTable();
        $this->connection=Base::getConnection();
        $this->base_Field=Base::getField();

        foreach ($this->base_Field as $key => $value) {
        	$this->fillable[]=$value['name'];
        }

        
        
    }


    public function checkSave(){


    	 $error=\MS\Core\MSDB::findDuplicate($this,'UniqId',$this->UniqId);
    	// dd($error);
    	 if(!$error['error']){
			$this->save();
			$error=['error'=>false,'msg'=>"User Succesfully added to Database."];
			return $error;
    	 }
    	 return $error;
    }







}
