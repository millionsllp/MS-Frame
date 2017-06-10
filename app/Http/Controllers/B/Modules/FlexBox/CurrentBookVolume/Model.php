<?php

namespace BECM\FlexBox\CurrentBookVolume;


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
        $row=$this->all();
        
        return $row;

    }



    public function updateCurrentVolume($data){
      $row=new Model();
     ///// dd($data);
        $row=$row->where('UnitName',$data['UnitName'])->first();
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

    public static function getTotal(){
        $return=[];
        $row=new Model();
        $data=$row->all()->sortByDesc('Quantity')->toArray();
        $total=$row->all()->sum('Quantity');
        $return['Total']=$total;
        $return['Percetage']="100";
        return $return;

    }

    

    public static function getAllData(){   
        $row=new Model();
        $data=$row->all()->sortByDesc('Quantity')->toArray();
        $total=$row->all()->sum('Quantity');
       // $return=[];
        foreach ($data as $key=>$value) {
            //dd( $value);
             $data[$key]['Percetage']=($value['Quantity']*100)/$total;

            
        }

        $return=collect($data);
         //dd($return);


        return $data;
    }

    public static function  getDataForQuantity(){
        $row=new Model();
        $data=$row->all()->sortByDesc('Quantity')->toArray();
       //return $data;
        $return=[];


        foreach ($data as $value) {
         $return[]=["y" => $value['Quantity'], "legendText" => $value['UnitName'], "label" => $value['UnitName']];   
        }

        return $return;


    }

     public static function  getDataForPercentage(){
        $row=new Model();
        $data=$row->all()->sortByDesc('Quantity');
        $dataArray=$data->toArray();

        $total=$data->sum('Quantity');

       //return $total;
        $return=[];


        foreach ($dataArray as $value) {
         $return[]=["y" => ($value['Quantity']*100)/$total, "legendText" => $value['UnitName'], "label" => $value['UnitName']];   
        }

        return $return;


    }

    






}
