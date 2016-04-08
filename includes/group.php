	<?php
require_once(LIB_PATH.DS."database.php");
/**
	 * The group class contains all the the various attributes associated with a group. This class is invoked everytime a user creates a new table.
	 * 
	 */
class Group extends DatabaseObject {
   	protected static $table_name = "wb_group";/*!<Name of table storing message data in database*/
    protected static $db_fields = array('id','group_name','group_owner','group_status','group_activity','group_discription');/*!< An array keeping track of all member variables of Group*/
    public $id;/*!< An 11-bit int  tracking group ID*/
    public $group_name ;/*!< A varchar of 256-bits containing the name of the group*/
    public $group_owner;/*!< An 11-bit int referring to the owner by user_id*/
    public $group_status;/*!< A varchar of 256-bits. Values are either public or private*/
    public $group_activity;/*!< A Varchar of 256-bits describing what activity the group meets for*/
    public $group_discription;/*!< A blob describing  the activity*/
    
	/**
	 * Places all members of a pre-existing group in an array
	 * 
	 * @return array containing all members of group
	 */
    public function get_members(){
    	global $database;
    	$sql = "SELECT * FROM wb_group_members WHERE group_id=".$this->id;
    	$group_member_array = $database->query($sql);
    	return $group_member_array;
    }
    /**
	 * Places all members of pre-existing  group in an array.
	 * 
	 * @return array containing user_id of all group members
	 */
    public function get_member_id_array(){
        global $database;
        $sql = "SELECT member_id FROM wb_group_members WHERE group_id=".$this->id;
        $member_id_array = array();
        $group_member_array = $database->query($sql);
        while($member_id = $group_member_array->fetch_assoc())
        {
            $member_id_array[] = $member_id;
        }
        return  $member_id_array;
    }
   
	/**
	 * Places the activity of pre-existing  group in an array.
	 * 
	 * @return array containing the group acitivity
	 */   
    public static function get_activity(){
    	global $database;
    	$sql = "SELECT * FROM wb_group_activity ORDER BY activity ASC";
    	$group_activity_result_set = $database->query($sql);
    	
    	$group_activity_array = array();
    	
    	while($row = $group_activity_result_set->fetch_assoc()){
    		$group_activity_array[] = $row['activity'];
    	}
    	
    	return($group_activity_array);
    }
}

?>

