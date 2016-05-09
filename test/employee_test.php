<?php 
/*
*	@file types_test.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments This file will run all the test for the Test_Data_Employee class.
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('../includes/initialize.php');
?>

<?php 
include('header.html');
?>

<!-- html goes here -->
<h1 class="page-header">Test_Data_Employee Testing</h1>
<p>Test_Data_Employee class created for testing purposes. This class is extened from DatabaseObject and do not contain any methods.</p>
<p>No testing is perfomred on this class.</p>
<h3 class="expand sub-header">Test_Data_Employee Class</h3>
<div class="well">
<xmp>
class Test_Data_Employee extends DatabaseObject {

    protected static $table_name="wb_test_data_employee";
    protected static $db_fields = array('id','first_name','last_name','job_title','salary');
    public $id;
    public $first_name;
    public $last_name;
    public $job_title;
    public $salary;
}
</xmp>
</div>

<?php
include('footer.html');
?>