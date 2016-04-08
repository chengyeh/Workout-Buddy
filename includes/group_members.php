<?php
require_once(LIB_PATH.DS."database.php");
/**
     * Class to store all members of a certain group in the group_members table.
     *
     * @param  
     * @return All rows from table are returned
     */
class GroupMember extends DatabaseObject {
   	protected static $table_name = "wb_group_members";/*!<Name of table storing group membership data in database*/
    protected static $db_fields = array('id','group_id','member_id');/*!< An array keeping track of all member variables of group_members*/
    public $id;/*!< Variable 11-bit INT variable keeping tracks of group_membership*/
    public $group_id;/*!< A 256-bit Varchar storing the groups name*/
    public $member_id;/*!< A 11-bit INT keeping tracking of which members are part of the group*/
}

?>