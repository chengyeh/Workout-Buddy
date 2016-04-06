<?php
require_once(LIB_PATH.DS."database.php");

class challenge extends DatabaseObject {
   	protected static $table_name = "challenge";
    protected static $db_fields = array('id','who', 'name', 'bench_press', 'pull_ups');
    public $id;
    public $who; //retrieve the user_id from the user (unique);
    public $name; //the name the user wish to appear
    public $bench_press = 0; //bench press (lbs)
    public $pull_ups = 0; //pull ups (numbers)

/*
    public function get_members(){
    	global $database;
    	$sql = "SELECT * FROM wb_group_members WHERE group_id=".$this->id;
    	$group_member_array = $database->query($sql);
    	return $database->fetch_array($group_member_array);
    }
*/
}

?>
