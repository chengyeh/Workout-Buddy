<?php 
/*
*	@file database_test.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments This file will run all the test for the databse class.
*/

require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Database Testing</h1>
<p>This seris of test will test <b>public</b> functions in MySQLDatabase class.</p>

<h3 class="expand sub-header">Test open_connection()</h3>
<div class="well" style="display:none;">
<xmp>
    public function open_connection(){
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (!$this->connection){
            die("Database connection failed. " . mysqli_error($this->connection));
        } else {
            $db_select = mysqli_select_db($this->connection, DB_NAME);
            if (!$db_select){
                die("Database selection failed. " . mysqli_error());
            }
        }
    }
</xmp>
</div>

<div class='well' style='background-color:  #b3e0ff'>
	<p>This function is not tested.</p>
</div>

<h3 class="expand sub-header">Test close_connection()</h3>
<div class="well" style="display:none;">
<xmp>
    public function close_connection(){
        if (isset($this->connection)){
            mysqli_close($this->connection);
            unset($this->connection);
        }
    }
</xmp>
</div>

<div class='well' style='background-color:  #b3e0ff'>
	<p>This function is not tested.</p>
</div>

<h3 class="expand sub-header">Test query($sql)</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of MySQLDatabase class
$database3 = new MySQLDatabase();

//Call query method
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
</xmp>
</div>
<?php 
//Create instance of MySQLDatabase class
$database3 = new MySQLDatabase();

//Call query method
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
<h3 class="expand sub-header">Test escape_value($value)</h3>
<div class="well" style="display:none;">
<xmp>
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
</xmp>
</div>
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

<h3 class="expand sub-header">Test fetch_array($result_set)</h3>

<div class="well" style="display:none;">
<xmp>
//Create instance of MySQLDatabase class
$database5 = new MySQLDatabase();

//Call query method
$result_set = $database5->query("SELECT * FROM wb_contact");

$result_array = $database5->fetch_array($result_set);

//wb_test_data_employee table is testing table that 
//have 8 rows in the table.

//Check result_array has more than zero elements
if (count($result_array) > 0) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test fetch_array(\$result_set) PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test fetch_array(\$result_set) FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database5);
</xmp>
</div>
<?php 
//Create instance of MySQLDatabase class
$database5 = new MySQLDatabase();

//Call query method
$result_set = $database5->query("SELECT * FROM  wb_test_data_employee");

$result_array = $database5->fetch_array($result_set);

//wb_test_data_employee table is testing table that 
//have 8 rows in the table.

//Check result_array has more than zero elements
if (count($result_array) > 0) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test fetch_array(\$result_set) PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test fetch_array(\$result_set) FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database5);
?>
<h3 class="expand sub-header">Test num_rows($result_set)</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of MySQLDatabase class
$database6 = new MySQLDatabase();

//Call query method
$result_set = $database6->query("SELECT * FROM wb_users");

$num_rows = $database6->num_rows($result_set);

//Check result_array has more than zero elements
if ($num_rows > 0) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test num_rows(\$result_set) PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test num_rows(\$result_set) FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database6);
</xmp>
</div>
<?php 
//Create instance of MySQLDatabase class
$database6 = new MySQLDatabase();

//Call query method
$result_set = $database6->query("SELECT * FROM wb_users");

$num_rows = $database6->num_rows($result_set);

//Check result_array has more than zero elements
if ($num_rows > 0) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test num_rows(\$result_set) PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test num_rows(\$result_set) FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database6);
?>
<h3 class="expand sub-header">Test insert_id()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of MySQLDatabase class
$database7 = new MySQLDatabase();

$sql_drop_table = "DROP TABLE wb_test_table";
$database7->query($sql_drop_table);

$sql_create_table = "CREATE TABLE wb_test_table ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, col_1 int(10) )";
$database7->query($sql_create_table);

$sql_insert_row = "INSERT INTO wb_test_table (`col_1`) VALUES (123)";
$database7->query($sql_insert_row);

//Check result_array has more than zero elements
if ($database7->insert_id() == 1) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test insert_id() PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test insert_id() FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database7);
</xmp>
</div>
<?php 
//Create instance of MySQLDatabase class
$database7 = new MySQLDatabase();

$sql_drop_table = "DROP TABLE wb_test_table";
$database7->query($sql_drop_table);

$sql_create_table = "CREATE TABLE wb_test_table ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, col_1 int(10) )";
$database7->query($sql_create_table);

$sql_insert_row = "INSERT INTO wb_test_table (`col_1`) VALUES (123)";
$database7->query($sql_insert_row);

//Check result_array has more than zero elements
if ($database7->insert_id() == 1) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test insert_id() PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test insert_id() FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database7);
?>
<h3 class="expand sub-header">Test affected_rows()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of MySQLDatabase class
$database8 = new MySQLDatabase();

$sql_drop_table = "DROP TABLE wb_test_table";
$database8->query($sql_drop_table);

$sql_create_table = "CREATE TABLE wb_test_table ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, col_1 int(10) )";
$database8->query($sql_create_table);

$sql_insert_row = "INSERT INTO wb_test_table (`col_1`) VALUES (123)";
$database8->query($sql_insert_row);

//Check result_array has more than zero elements
if ($database8->affected_rows() == 1) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test affected_rows() PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test affected_rows() FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database8);
</xmp>
</div>
<?php 
//Create instance of MySQLDatabase class
$database8 = new MySQLDatabase();

$sql_drop_table = "DROP TABLE wb_test_table";
$database8->query($sql_drop_table);

$sql_create_table = "CREATE TABLE wb_test_table ( id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, col_1 int(10) )";
$database8->query($sql_create_table);

$sql_insert_row = "INSERT INTO wb_test_table (`col_1`) VALUES (123)";
$database8->query($sql_insert_row);

//Check result_array has more than zero elements
if ($database8->affected_rows() == 1) {
	//
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test affected_rows() PASSED";
	echo "</div>";

}else{
	//
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test affected_rows() FAILED";
	echo "</div>";
}

//Delete MySQLDatabase object
unset($database8);
?>

<?php
include('footer.html');
?>