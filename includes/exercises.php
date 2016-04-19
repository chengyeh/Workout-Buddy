<?php
require_once(LIB_PATH.DS."database.php");

class Exercises extends DatabaseObject {
   	protected static $table_name = "wb_exercise";
    protected static $db_fields = array('id','routine_id','type');
    public $id;
    public $routine_id;
    public $type;
	
	public function get_sets(){
    	$sql = "SELECT * FROM wb_exercise_set WHERE exercise_id=".$this->id. " ORDER BY 'order' ASC";
    	$sets_object_array = Set::find_by_sql($sql);
    	return $sets_object_array;
    }

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
