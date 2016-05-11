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
 * This class's only purpose is to create a object for testing database_object
* class. It is not used in the Workout Buddy web application.
* wb_test_data_employee table in mysql database and the the data it contains
* also only used in testing purposes and not part of the web application.
*/

require_once(LIB_PATH.DS."database.php");

class Test_Data_Employee extends DatabaseObject {

    protected static $table_name="wb_test_data_employee";
    protected static $db_fields = array('id','first_name','last_name','job_title','salary');
    public $id;
    public $first_name;
    public $last_name;
    public $job_title;
    public $salary;
}