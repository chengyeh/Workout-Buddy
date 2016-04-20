<?php
require_once(LIB_PATH.DS."database.php");

class Types extends DatabaseObject {
   	protected static $table_name = "wb_exercise_type";
    protected static $db_fields = array('id','name','image_filename');
    public $id;
    public $name;
	public $image_filename;

   public function show_types()
   {
    	$sql = "SELECT * FROM wb_exercise_type";
    	$types_object_array = Types::find_by_sql($sql);
    	return $types_object_array;
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
