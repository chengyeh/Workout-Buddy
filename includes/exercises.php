<?php
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create an exercise object
 * @pre: User session, routine object
 * @post: Database access
 * @return: Creates an exercise object
 */
class Exercises extends DatabaseObject {
    protected static $table_name = "wb_exercise";/*!<Name of table storing exercise information data in database*/
    protected static $db_fields = array('id','routine_id','type');/*!< An array keeping track of all member variables of exercises.php*/
    public $id;/*!< A 11-bit INT variable keeping track of an exercises id*/
    public $routine_id;/*!< A 11-bit INT variable keeping track of a routine id associated with an exercise*/
    public $type;/*!< A 11-bit INT variable keeping track of an exercise type*/


     /**
	 * This class is used to create an exercise object
	 * @pre: exercise_id
	 * @post: Database access
	 * @return: Array of sets for a designated exercise object
	 */
    public function get_sets()
    {
        $sql = "SELECT * FROM wb_exercise_set WHERE exercise_id=".$this->id. " ORDER BY id ASC";
        $sets_object_array = Set::find_by_sql($sql);
        return $sets_object_array;
    }


}
?>
