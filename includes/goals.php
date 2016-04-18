<?php
require_once(LIB_PATH.DS."database.php");

class Goals extends DatabaseObject {
   	protected static $table_name = "wb_goals";
    protected static $db_fields = array('id','DOW','count','trigger');
    public $id;
    public $DOW;
    public $count;
    public $trigger;

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
