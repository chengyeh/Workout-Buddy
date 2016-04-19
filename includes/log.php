<?php
require_once(LIB_PATH.DS."database.php");

class Log extends DatabaseObject {
    protected static $table_name = "wb_user_log";
    protected static $db_fields = array('id','user_id','routine_id','exercise_id','exercise_type_id','set_id','reps','weight','date','time');
    public $id;
    public $user_id;
    public $routine_id;
    public $exercise_id;
    public $exercise_type_id;
    public $set_id;
    public $reps;
    public $weight;
    public $date;
    public $time;


}
?>