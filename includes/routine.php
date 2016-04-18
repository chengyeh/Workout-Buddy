<?php
require_once(LIB_PATH.DS."database.php");

class Routine extends DatabaseObject {
   	protected static $table_name = "wb_routine";
    protected static $db_fields = array('id','user_id','name','description','mon', 'tues','wed','thurs','fri','sat','sun');
    public $id;
    public $user_id;
    public $name;
    public $description;
    public $mon;
    public $tues;
    public $wed;
    public $thurs;
    public $fri;
    public $sat;
    public $sun;
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
