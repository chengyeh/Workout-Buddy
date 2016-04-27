<?php
require_once(LIB_PATH.DS."database.php");

class Log extends DatabaseObject {
    protected static $table_name = "wb_user_log";
    protected static $db_fields = array('id','user_id','routine_id','exercise_id','category_id','exercise_type_id','set_id','reps','weight','date','time');
    public $id;
    public $user_id;
    public $routine_id;
    public $exercise_id;
    public $category_id;
    public $exercise_type_id;
    public $set_id;
    public $reps;
    public $weight;
    public $date;
    public $time;

    public function set_log_helper($ord)
	{
		$ord;
    	global $database;
    	$sql = "SELECT `id` FROM `wb_exercise_set` WHERE `order`=".$ord." AND `exercise_id`=".$this->exercise_id;
    	$log_help_array = $database->query($sql);
    	return $log_help_array;
    }


}
?>
