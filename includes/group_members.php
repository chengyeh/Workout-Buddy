<?php
require_once(LIB_PATH.DS."database.php");

class GroupMember extends DatabaseObject {
   	protected static $table_name = "wb_group_members";
    protected static $db_fields = array('id','group_id','member_id');
    public $id;
    public $group_id;
    public $member_id;
}

?>