<?php
// Workout Buddy Manual
// 
//    
// Copyright (C) <2016>  <Paul Charles, Kuei-Hsien Chu, Purna Doddapaneni, Dilesh Fernando, Cheng-Yeh Lee>
// 
// This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
// 
// You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
?>
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
    public $id;/*!< A variable keeping track of types ID*/
    public $name;/*!< A variable keeping track of types name*/
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
