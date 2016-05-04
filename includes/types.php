<?php
/*
 *	@file types.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Helper class use to query all the excersice types
*				form wb_exercise_type table for form input.
*/

require_once(LIB_PATH.DS."database.php");

class Types extends DatabaseObject
{
	protected static $table_name = "wb_exercise_type";/*!<Name of table storing exercise type data in database*/
    protected static $db_fields = array('id','name','image_filename');/*!< An array keeping track of all member variables of types.php*/
    public $id;/*!< A 11-bit INT variable keeping track of types ID*/
    public $name;/*!< A 11-bit INT variable keeping track of types name*/
	public $image_filename;/*!< A renderable image associated with a types ID*/

	/**
	 * This method queries all the exercise types from the database. 
	 *
	 * @return types objects in a array
	 */
   	public function show_types()
   	{
    	$sql = "SELECT * FROM wb_exercise_type";
    	$types_object_array = Types::find_by_sql($sql);
    	return $types_object_array;
   	}
}
?>
