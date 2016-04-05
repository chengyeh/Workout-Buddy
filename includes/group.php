<?php
require_once(LIB_PATH.DS."database.php");

class Group extends DatabaseObject {
   	protected static $table_name = "wb_group";
    protected static $db_fields = array('id','group_name','group_owner');
    public $id;
    public $group_name;
    public $group_owner;
    
    public function get_members(){
    	global $database;
    	$sql = "SELECT * FROM wb_group_members WHERE group_id=".$this->id;
    	$group_member_array = $database->query($sql);
    	return $database->fetch_array($group_member_array);
    }
}

