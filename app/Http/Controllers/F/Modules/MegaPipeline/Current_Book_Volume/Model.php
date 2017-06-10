<?php

namespace FECM\ModuleCode\SubModuleCode1;



class Model extends Illuminate\Database\Eloquent\Model
{

protected $table;

	public function __construct()
    {
        $this->table=new \Model\jbAccount\Master ();
        
        
    }




}
