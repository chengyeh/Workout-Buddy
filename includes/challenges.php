<?php
require_once(LIB_PATH.DS."database.php");

class Group extends DatabaseObject {
   	protected static $table_name = "challenges";
    protected static $db_benchPress = array('id','name','bench_press');
    protected static $db_pullUps = array('id','name','pull_ups');
    public $id;
    public $name;
    public $bench_press = 0;
    public $pull_ups = 0;

/*
    public function get_members(){
    	global $database;
    	$sql = "SELECT * FROM wb_group_members WHERE group_id=".$this->id;
    	$group_member_array = $database->query($sql);
    	return $database->fetch_array($group_member_array);
    }
*/
}
