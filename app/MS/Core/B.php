<?php

namespace MS\Core;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class B {


	function __construct() {	
    
   	}


   	public static function r($path,$b=true){
		if($b){
   		require_once (app_path().DS."Http".DS."Controllers".DS."B".DS.$path.".php");
   		return true;
   		}
   		require_once (app_path().DS."Http".DS."Controllers".DS."F".DS.$path.".php");
   		return true;
   	}

      public static function makeColumn($table,$name,$type="string",$default=""){
         
         switch ($type) {
            case 'boolean':
               $table->boolean($name)->default(false);
               break;
            
            default:
               if($default !=""){
                  $table->string($name);
               }else{
                  $table->string($name);
               }               
               break;
         }
         
      }

      public static function makeTable($name,$array,$connection=""){
            if($connection!=""){
               Schema::connection($connection)->create($name, function (Blueprint $table)use ($array)  {
                $table->increments('id');
             foreach ($array as $value) {
                     
                     self::makeColumn($table,$value['name'],$value['type']);

                  }           
                  $table->timestamps();
              }); 
            }else
            {
                  Schema::create($name, function (Blueprint $table) use ($array) {
                    $table->increments('id');
             foreach ($array as $value) {
                     
                     self::makeColumn($table,$value['name'],$value['type']);

                  }           
                  $table->timestamps();
              }); 
            }

            

      }

      public static function deleteTable($name,$connection=""){
       //   dd($name);
          if ($connection != "") {
          Schema::connection($connection)->drop($name);
          }else{
          Schema::drop($name);  
          }
          
      }


      public static function getYr(){return date('Y');}

      public static function getMon(){return date('m');}

      public static function getCDate(){return date("Y-m-d");}
      public static function getFDate($day=0){return date("Y-m-d",strtotime(date("Y-m-d")." +".$day." days"));}



}


