<?php
require_once(LIB_PATH.DS."database.php");

class Event_Calendar extends DatabaseObject {
   	protected static $table_name = "wb_event_calendar";
    protected static $db_fields = array('id','user_id','name','description','event_date');
    public $id;
    public $user_id;
    public $name;
    public $description;
    public $event_date;
}
?>