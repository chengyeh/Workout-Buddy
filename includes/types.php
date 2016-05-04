<?php
/*
 *	@file types.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Helper class use to query all the excersice types
*				form wb_exercise_type table for form input.
*/

require_once(LIB_PATH.DS."database.php");

class Types extends DatabaseObject {
   	protected static $table_name = "wb_exercise_type";
    protected static $db_fields = array('id','name','image_filename');
    public $id;
    public $name;
	public $image_filename;

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
