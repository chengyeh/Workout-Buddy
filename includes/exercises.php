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
 * This class is used to create an exercise object
 * @pre: User session, routine object
 * @post: Database access
 * @return: Creates an exercise object
 */
class Exercises extends DatabaseObject {
    protected static $table_name = "wb_exercise";/*!<Name of table storing exercise information data in database*/
    protected static $db_fields = array('id','routine_id','type');/*!< An array keeping track of all member variables of exercises.php*/
    public $id;/*!< A variable keeping track of an exercises id*/
    public $routine_id;/*!< A variable keeping track of a routine id associated with an exercise*/
    public $type;/*!< A variable keeping track of an exercise type*/


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
