<?php
require_once(LIB_PATH.DS."database.php");

class Routine extends DatabaseObject {
   	protected static $table_name = "wb_routine";
    protected static $db_fields = array('id','user_id','name','description','mon', 'tues','wed','thurs','fri','sat','sun','start_date','end_date');
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
	public $start_date;
    public $end_date;

    public function get_exercises(){
    	$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$this->id. " ORDER BY id ASC";
    	$exercises_object_array = Exercises::find_by_sql($sql);
    	return $exercises_object_array;
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
