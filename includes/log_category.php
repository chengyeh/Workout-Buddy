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
require_once(LIB_PATH.DS."database.php");
/**
 * This class is used to create a category object for viewing logs
 * @pre: routine.php object, exercise.php object, set.php object
 * @post: Database access
 * @return: Creates a log category object
 */
class Category extends DatabaseObject {
    protected static $table_name = "wb_log_category";/*!<Name of table storing category data in database*/
    protected static $db_fields = array('id','user_id','routine_id', 'exercise_id', 'Date', 'Time');/*!< An array keeping track of all member variables of log_category.php*/
    public $id;/*!< A variable keeping track of log category ID*/
    public $user_id;/*!< A variable keeping track of user session ID*/
    public $routine_id;/*!< A variable keeping track of routine ID associated with the log*/
    public $exercise_id;/*!< A variable keeping track of the exercise ID associated with the log's routine*/
    public $Date;/*!< A unlimited text field that stores the date of the log*/
    public $Time;/*!< A unlimited text field that stores the time of the log*/


	/**
	 * log_exercises1() is used to obtain all the log with the same category id and user id
	 * @pre: routine.php, exercise.php, set.php for the associated logs
	 * @post: Database access
	 * @return: Array that contains all log ids with a given category id and user id
	 */
    public function log_exercises1()
	{
		global $database;
    	$sql = "SELECT * FROM wb_user_log WHERE category_id=".$this->id." AND user_id=".$this->user_id;
    	$log_array = $database->query($sql);
    	return $log_array;
	}

}
?>
