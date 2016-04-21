<?php
require_once(LIB_PATH.DS."database.php");

class Set extends DatabaseObject {
   	protected static $table_name = "wb_exercise_set";
    protected static $db_fields = array('id','exercise_id','routine_id','order','reps','weight');
    public $id;
    public $exercise_id;
    public $routine_id;
    public $order;
    public $reps;
    public $weight;

   /*
   public function show_types()
   {
    	$sql = "SELECT * FROM wb_exercise_type";
    	$types_object_array = Types::find_by_sql($sql);
    	return $types_object_array;
    }

	 public function initialize(){
        if($this->active == 1){
            return true;
        }else{
            return false;
        }

    }*/
}
?>
