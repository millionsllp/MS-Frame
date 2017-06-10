<?php

namespace BECM\FlexBox\BasicDetails;


class Model extends \Illuminate\Database\Eloquent\Model
{

protected $table;
protected $connection;
protected $fillable;
protected $base_Field;


	public function __construct()
    {
        $this->table=Base::getTable();
        $this->connection=Base::getConnection();
        $this->base_Field=Base::getField();
     
        foreach ($this->base_Field as $key => $value) {
        	$this->fillable[]=$value['name'];
        }

        
        
    }


    public function genuniqid(){
        return Base::genUniqID();
    }


    public function viewRowList(){
        $row=$this->all()->first();
        
        return $row;

    }


public function updateDetails($data){
      $row=new Model();
        $row=$row->where('UniqId',$data['UniqId'])->first();
        //dd($row);
          //  $data['AttachmentsArray']="array";
             if(array_key_exists('_token', $data))unset($data['_token']);
       
        foreach ($data as $key => $value) {
            $row->$key=$value;
            
        }



        $row->save();
        return ['status'=>'200','msg'=>"Data Succesfully added to Database."];
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
