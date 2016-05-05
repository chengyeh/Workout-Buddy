<?php
/**
 *  @file group_members.php
 *  @date 5/4/2016
 *  @comments Helper class use to query all the group members
 *              form wb_group_members table for form input.
 */

require_once(LIB_PATH.DS."database.php");

class GroupMember extends DatabaseObject {
   	protected static $table_name = "wb_group_members"; /*!<Name of table storing group member data in database*/
    protected static $db_fields = array('id','group_id','member_id'); /*!< An array keeping track of all member variables of group_members.php*/
    public $id; /*!< A 11 digits INT keeping track of group members ID*/
    public $group_id; /*!< A 11 digits INT keeping track of groups (wb_group) ID*/
    public $member_id; /*!< A 11 digits INT keeping track of group members (wb_users) ID*/
}

?>