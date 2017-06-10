<?php

namespace FECM\MegaPipeline\Blue_Print;


class Model extends \Illuminate\Database\Eloquent\Model
{

protected $table;

	public function __construct()
    {
        $this->table=new \Model\jbAccount\Master ();
        
        
    }




}
