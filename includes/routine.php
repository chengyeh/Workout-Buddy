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
 * This class is used to create a routine object
 * @pre: User session
 * @post: Database access
 * @return: Creates a routine object
 */
class Routine extends DatabaseObject {
   	protected static $table_name = "wb_routine";/*!<Name of table storing exercise routine data in database*/
    protected static $db_fields = array('id','user_id','name','description','mon', 'tues','wed','thurs','fri','sat','sun','start_date','end_date');/*!< An array keeping track of all member variables of routine.php*/
    public $id;/*!< A variable keeping track of Routine ID*/
    public $user_id;/*!< A variable keeping track of Routine user_id*/
    public $name;/*!< A variable keeping track of Routine name*/
    public $description;/*!< A variable keeping track of Routine description*/
    public $mon;/*!< A variable keeping track of Monday status for a Routine*/
    public $tues;/*!< A variable keeping track of Tuesday status for a Routine*/
    public $wed;/*!< A variable keeping track of Wednesday status for a Routine*/
    public $thurs;/*!< A variable keeping track of Thursday status for a Routine*/
    public $fri;/*!< A variable keeping track of Friday status for a Routine*/
    public $sat;/*!< A variable keeping track of Saturday status for a Routine*/
    public $sun;/*!< A variable keeping track of Sunday status for a Routine*/
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
