<?php

namespace BECM\Announcements\Data;


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


    public function MSviewDataList(){
        $row=$this->all();
        
        return $row;

    }

    public function MSdeleteRow($data){
        $row=new Model();

        //dd($data);
        $row=$row->where('UniqId',$data['UniqId'])->first();
        $row->delete();
        return ['status'=>'200','msg'=>"Data Succesfully removed to Database."];
    }

    public function MSupdateRow($data){

        $row=new Model();
        $row=$row->where('UniqId',$data['UniqId'])->first();
        //dd($row);
          //  $data['AttachmentsArray']="array";
            if(!(array_key_exists('Attachments', $data)))$data['Attachments']="array";
             if(array_key_exists('_token', $data))unset($data['_token']);
       
        foreach ($data as $key => $value) {
            $row->$key=$value;
            
        }



        $row->save();
        return ['status'=>'200','msg'=>"Data Succesfully added to Database."];

    }

    public function MSaddRow($data){
            
            $row=new Model();
          //  $data['AttachmentsArray']="array";
            if(!(array_key_exists('Attachments', $data)))$data['Attachments']="array";
             if(array_key_exists('_token', $data))unset($data['_token']);
        foreach ($data as $key => $value) {
            $row->$key=$value;
            
        }

        if($row->checkSave()['error']){
            return ['status'=>'200'];
        }
            return ['status'=>'200','msg'=>$row->checkSave()];
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
