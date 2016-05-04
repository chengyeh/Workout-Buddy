<?php
/*
*	@file event_calendar.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Helper class the aids to create a Event_Calendar object for
*				for calendar input from the user in form data.
*/

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