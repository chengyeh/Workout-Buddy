<?php
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create a exercise types object
 * @pre: User session, routine object, exercise object
 * @post: Database access
 * @return: Creates an exercise types object
 */
class Types extends DatabaseObject
{
	protected static $table_name = "wb_exercise_type";/*!<Name of table storing exercise type data in database*/
    protected static $db_fields = array('id','name','image_filename');/*!< An array keeping track of all member variables of types.php*/
    public $id;/*!< A 11-bit INT variable keeping track of types ID*/
    public $name;/*!< A 11-bit INT variable keeping track of types name*/
	public $image_filename;/*!< A renderable image associated with a types ID*/


  /**
   * show_types is used to select all exercise with a designated type from the database
   * @pre: types object
   * @post: Database access
   * @return: Array that contains all exercises with a certain type
   */
   public function show_types()
   {
    	$sql = "SELECT * FROM wb_exercise_type";
    	$types_object_array = Types::find_by_sql($sql);
    	return $types_object_array;
    }


}
?>
