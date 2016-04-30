<?php 
require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Database Testing</h1>
<p>This seris of test will test the database class and it's methods.</p>

<h3 class="sub-header">Test open_connection()</h3>
<h3 class="sub-header">Test close_connection()</h3>
<h3 class="sub-header">Test query($sql)</h3>
<?php 
$database3 = new MySQLDatabase();
$result = $database3->query("SELECT * FROM wb_users");
if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test query(\$sql) PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test query(\$sql) FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database3);
?>
<h3 class="sub-header">Test escape_value($value)</h3>
<?php 
//Create instance of MySQLDatabase class
$database4 = new MySQLDatabase();

//Create test string with apostrophe.
$test_string = "Joe O'Brien";

//Call the escape_value method
$result = $database4->escape_value($test_string);

//Check result contains backslash charactor
if (strpos($result, '\\') !== FALSE) {
	//String contains backslash
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test escape_value(\$value) PASSED";
	echo "</div>";
	
}else{
	//String do not contain backslash
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test escape_value(\$value) FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database4);
?>

<h3 class="sub-header">Test fetch_array($result_set)</h3>
<h3 class="sub-header">Test num_rows($result_set)</h3>
<h3 class="sub-header">Test insert_id()</h3>
<h3 class="sub-header">Test affected_rows()</h3>
<h3 class="sub-header">Test confirm_query($result)</h3>
<?php
include('footer.html');
?>