<?php
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create a log object
 * @pre: exercise.php object
 * @post: Database access
 * @return: Creates a log object
 */

class Log extends DatabaseObject
{
    protected static $table_name = "wb_user_log";/*!<Name of table storing exercise log data in database*/
    protected static $db_fields = array('id','user_id','routine_id','exercise_id','category_id','exercise_type_id','set_id','reps','weight','date','time');/*!< An array keeping track of all member variables of log.php*/
    public $id;/*!< A variable keeping track of Log ID*/
    public $user_id;/*!< A variable keeping track of a log object's user_id*/
    public $routine_id;/*!< A variable keeping track of a log object's routine ID*/
    public $exercise_id;/*!< A variable keeping track of a log object's exercise ID*/
    public $category_id;/*!< A variable keeping track of a log object's category ID*/
    public $exercise_type_id;/*!< A variable keeping track of a log object's exercise type ID*/
    public $set_id;/*!< A variable keeping track of a log object's exercise set ID*/
    public $reps;/*!< A variable keeping track of a log object's reps*/
    public $weight;/*!< A variable keeping track of a log object's weight*/
    public $date;/*!< A non-limited text field keeping track of a log object's date*/
    public $time;/*!< A non-limited text field keeping track of a log object's time*/


	/**
	 * set_log_helper() is used to get all the ids of an exercise set where the order and exercise are the same
	 * @pre: $ord (order of the exercise) and an exercise
	 * @post: Database access
	 * @return: Array that contains all exercise set ids with a given order and exercise
	 */
    public function set_log_helper($ord)
	{
		$ord;
    	global $database;
    	$sql = "SELECT `id` FROM `wb_exercise_set` WHERE `order`=".$ord." AND `exercise_id`=".$this->exercise_id;
    	$log_help_array = $database->query($sql);
    	return $log_help_array;
    }


}
?>
