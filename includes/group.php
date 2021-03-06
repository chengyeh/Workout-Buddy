<?php
// Workout Buddy Manual
// 
//    
// Copyright (C) <2016>  <Paul Charles, Kuei-Hsien Chu, Purna Doddapaneni, Dilesh Fernando, Cheng-Yeh Lee>
// 
// This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
// 
// You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
?>
<?php
/**
 *  @file group.php
 *  @date 5/4/2016
 *  @comments Helper class use to query all the groups
 *              form wb_group table for form input.
 */

require_once(LIB_PATH.DS."database.php");

class Group extends DatabaseObject {
   	protected static $table_name = "wb_group"; /*!<Name of table storing group data in database*/
    protected static $db_fields = array('id','group_name','group_owner','group_status','group_activity','group_discription'); /*!< An array keeping track of all member variables of group.php*/
    public $id; /*!< A 11 digits INT keeping track of group ID*/
    public $group_name; /*!< A 255 characters VARCHAR keeping track of groups name*/
    public $group_owner; /*!< A 11 digits INT keeping track of group owner (wb_users) ID*/
    public $group_status; /*!< A 255 characters VARCHAR keeping track of groups status*/
    public $group_activity; /*!< A 150 characters VARCHAR keeping track of groups activity*/
    public $group_discription; /*!< A text variable keeping track of groups description*/
    
    /**
     * This method queries all the group members from the wb_group_members table where its group_id matches its caller's id
     *
     * @return GroupMmeber objects in a array
     */
    public function get_members(){
    	global $database;
    	$sql = "SELECT * FROM wb_group_members WHERE group_id=".$this->id;
    	$group_member_array = $database->query($sql);
    	return $group_member_array;
    }
    
    /**
     * This method queries all the member_id from the wb_group_members table where its group_id matches its caller's id
     *
     * @return GroupMmeber objects in a array
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
     * This method queries all the group activities from the database. 
     *
     * @return group activities in a array
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

