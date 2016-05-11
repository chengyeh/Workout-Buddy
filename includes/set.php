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
 * This class is used to create a set object
 * @pre: exercise.php object, routine.php object, user session
 * @post: Database access
 * @return: Creates a set object
 */
class Set extends DatabaseObject {
   	protected static $table_name = "wb_exercise_set";/*!<Name of table storing exercise set data in database*/
    protected static $db_fields = array('id','exercise_id','routine_id','order','reps','weight');/*!< An array keeping track of all member variables of set.php*/
    public $id;/*!< A variable keeping track of set ID*/
    public $exercise_id;/*!< A variable keeping track of the exercise id associated with the set*/
    public $routine_id;/*!< A variable keeping track of the routine id associated with an set*/
    public $order;/*!< A variable keeping track of the order the set is supposed to be done*/
    public $reps;/*!< A variable keeping track of the amount of reps for each set*/
    public $weight;/*!< A variable keeping track of the amount of weight for each rep*/
}
?>
