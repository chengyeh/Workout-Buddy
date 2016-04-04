<?php
require_once(LIB_PATH.DS."database.php");

class Group extends DatabaseObject {
   	protected static $table_name="wb_group";
    protected static $db_fields = array('id','group_name','group_owner');
    public $id;
    public $group_name;
    public $group_owner;

}