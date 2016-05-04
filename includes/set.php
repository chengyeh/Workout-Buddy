<?php
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create a set object
 * @pre: exercise.php object, routine.php object, user session
 * @post: Database access
 * @return: Creates a set object
 */
class Set extends DatabaseObject {
   	protected static $table_name = "wb_exercise_set";/*!<Name of table storing exercise set data in database*/
    protected static $db_fields = array('id','exercise_id','routine_id','order','reps','weight');/*!< An array keeping track of all member variables of set.php*/
    public $id;/*!< A 11-bit INT variable keeping track of set ID*/
    public $exercise_id;/*!< A 11-bit INT variable keeping track of the exercise id associated with the set*/
    public $routine_id;/*!< A 11-bit INT variable keeping track of the routine id associated with an set*/
    public $order;/*!< A 11-bit INT variable keeping track of the order the set is supposed to be done*/
    public $reps;/*!< A 11-bit INT variable keeping track of the amount of reps for each set*/
    public $weight;/*!< A 11-bit INT variable keeping track of the amount of weight for each rep*/


}
?>
