<?php
require_once(LIB_PATH.DS."database.php");

class Exercise extends DatabaseObject {
   	protected static $table_name = "wb_exercises";
    protected static $db_fields = array('x_id','x_user_id','x_description','x_type', 'trigger','reps');
    public $x_id;
    public $x_user_id;
    public $x_description;
    public $x_type;
    public $trigger;
    public $reps;
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
