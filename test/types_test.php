<?php 
/*
*	@file types_test.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments This file will run all the test for the Type class.
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('../includes/initialize.php');
?>

<?php 
include('header.html');
?>

<!-- html goes here -->
<h1 class="page-header">Type Testing</h1>
<p>This seris of test will test <b>public</b> functions in Type class.</p>

<h3 class="expand sub-header">Test show_types()</h3>
<div class="well" style="display:none;">
<xmp>
//Database table wb_exercise_type contains 285 rows of data.
//This test will call show_types(), which will query all the 
//the data from the table.
//To test the method, show_types() will return 285 objects in
//array.

//Create Type object
$types_object = new Types();

//Call show_types()
$types_object_array = $types_object->show_types();

//Count number of objects in the array
$result = count($types_object_array);

//Check the number of objects = 285
if($result == 285){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test  show_types() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test show_types() FAILED";
	echo "</div>";
}

//Unset variables
unset($types_object_array);
</xmp>
</div>
<?php 
//Database table wb_exercise_type contains 285 rows of data.
//This test will call show_types(), which will query all the 
//the data from the table.
//To test the method, show_types() will return 285 objects in
//array.

//Create Type object
$types_object = new Types();

//Call show_types()
$types_object_array = $types_object->show_types();

//Count number of objects in the array
$result = count($types_object_array);

//Check the number of objects = 285
if($result == 285){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test  show_types() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test show_types() FAILED";
	echo "</div>";
}

//Unset variables
unset($types_object_array);
?>

<?php
include('footer.html');
?>