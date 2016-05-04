<?php
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create a routine object
 * @pre: User session
 * @post: Database access
 * @return: Creates a routine object
 */
class Routine extends DatabaseObject {
   	protected static $table_name = "wb_routine";/*!<Name of table storing exercise routine data in database*/
    protected static $db_fields = array('id','user_id','name','description','mon', 'tues','wed','thurs','fri','sat','sun','start_date','end_date');/*!< An array keeping track of all member variables of routine.php*/
    public $id;/*!< A 11-bit INT variable keeping track of Routine ID*/
    public $user_id;/*!< A 11-bit INT variable keeping track of Routine user_id*/
    public $name;/*!< A 11-bit INT variable keeping track of Routine name*/
    public $description;/*!< A 11-bit INT variable keeping track of Routine description*/
    public $mon;/*!< A 11-bit INT variable keeping track of Monday status for a Routine*/
    public $tues;/*!< A 11-bit INT variable keeping track of Tuesday status for a Routine*/
    public $wed;/*!< A 11-bit INT variable keeping track of Wednesday status for a Routine*/
    public $thurs;/*!< A 11-bit INT variable keeping track of Thursday status for a Routine*/
    public $fri;/*!< A 11-bit INT variable keeping track of Friday status for a Routine*/
    public $sat;/*!< A 11-bit INT variable keeping track of Saturday status for a Routine*/
    public $sun;/*!< A 11-bit INT variable keeping track of Sunday status for a Routine*/
	public $start_date;/*!< A datetime field keeping track of the start date of a Routine*/
    public $end_date;/*!< A datetime field keeping track of the end date of a Routine*/

	 /**
	 * get_exercises() is used to get all the exercises
	 * @pre: Routine created
	 * @post: Database access
	 * @return: Array with all exercises with that routine id
	 */
    public function get_exercises()
    {
    	$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$this->id. " ORDER BY id ASC";
    	$exercises_object_array = Exercises::find_by_sql($sql);
    	return $exercises_object_array;
    }

}
?>
