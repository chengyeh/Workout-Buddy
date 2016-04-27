<?php
require_once(LIB_PATH.DS."database.php");

class Category extends DatabaseObject {
    protected static $table_name = "wb_log_category";
    protected static $db_fields = array('id','user_id','routine_id', 'exercise_id', 'Date', 'Time');
    public $id;
    public $user_id;
    public $routine_id;
    public $exercise_id;
    public $Date;
    public $Time;



    public function log_exercises1()
	{
		global $database;
    	$sql = "SELECT * FROM wb_user_log WHERE category_id=".$this->id." AND user_id=".$this->user_id;
    	$log_array = $database->query($sql);
    	return $log_array;
	}

}
?>
