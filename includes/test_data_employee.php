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