<?php
require_once(LIB_PATH.DS."database.php");

class Exercises extends DatabaseObject {
   	protected static $table_name = "wb_exercise";
    protected static $db_fields = array('id','routine_id','type');
    public $id;
    public $routine_id;
    public $type;

/*
	 public function initialize(){
        if($this->active == 1){
            return true;
        }else{
            return false;
        }

    }*/
}
?>
