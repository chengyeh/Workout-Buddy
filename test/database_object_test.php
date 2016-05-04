<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Database Object Testing</h1>
<p>This seris of test will test the database_object class and it's methods.</p>
<p>For this seris of tests following table wb_test_data_employee table is used. This table contains 8 rows of sample data
and which will be queryed for testing database_object class.</p>
<?php
//show wb_test_data_employee table and all the rows 
 $result = $database->query("SELECT * FROM wb_test_data_employee");
 if ($database->num_rows($result)>0){
	 $r = mysqli_fetch_array($result,MYSQL_ASSOC);
	 $table="<table  class='table table-striped table-bordered'><tr>";
	 $firstLine="<tr>";
 foreach ($r as $k => $v){
   $table .="<th>".$k."</th>";
   $firstLine .="<td>".$v."</td>";
 }
 $table.="</tr>".$firstLine."</tr>";
 while($r = mysqli_fetch_array($result,MYSQL_ASSOC)){
   $table.="<tr>";
   foreach($r as $k => $v)
     $table.="<td>".$v."</td>";
   $table.="</tr>";
 }
  $table .="</table>";
 echo $table;
}
?>

<h3 class="expand sub-header">Test find_all()</h3>
<div class="well" style="display:none;">
<xmp>
//Test database table wb_test_data_employee contains 8 row of data.
//This test will call find_all() on wb_test_data_employee table
//that will create 8 Test_Data_Employee objects out of 8 rows of data
//in the table.

$temp_employee_object_array = Test_Data_Employee::find_all();

$result = count($temp_employee_object_array);

if($result == 8){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test  find_all() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test find_all() FAILED";
	echo "</div>";
}

unset($temp_employee_object_array);
</xmp>
</div>
<?php
//Test database table wb_test_data_employee contains 8 row of data.
//This test will call find_all() on wb_test_data_employee table
//that will create 8 Test_Data_Employee objects out of 8 rows of data
//in the table.

$temp_employee_object_array = Test_Data_Employee::find_all();

$result = count($temp_employee_object_array);

if($result == 8){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test  find_all() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test find_all() FAILED";
	echo "</div>";
}

unset($temp_employee_object_array);
?>

<h3 class="expand sub-header">Test find_by_id($id=0)</h3>
<div class="well" style="display:none;">
<xmp>
//Test database table wb_test_data_employee contains 8 row of data.
//Id 5 is Eliza Cliford. This test will create a Test_Data_Employee object
//out of row that have the id=5 from wb_test_data_employee table.

$temp_employee_object = Test_Data_Employee::find_by_id(5);

if($temp_employee_object->first_name == "Eliza" && $temp_employee_object->last_name == "Clifford"){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test find_by_id() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test find_by_id() FAILED";
	echo "</div>";
}

unset($temp_employee_object);
</xmp>
</div>
<?php
//Test database table wb_test_data_employee contains 8 row of data.
//Id 5 is Eliza Cliford. This test will create a Test_Data_Employee object
//out of row that have the id=5 from wb_test_data_employee table.

$temp_employee_object = Test_Data_Employee::find_by_id(5);

if($temp_employee_object->first_name == "Eliza" && $temp_employee_object->last_name == "Clifford"){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test find_by_id() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test find_by_id() FAILED";
	echo "</div>";
}

unset($temp_employee_object);
?>

<h3 class="expand sub-header">Test find_by_sql($sql="")</h3>
<div class="well" style="display:none;">
<xmp>
//Test database table wb_test_data_employee contains 8 row of data.
//Id 5 is Eliza Cliford. This test will create a Test_Data_Employee object
//out of row that have the id=5 from wb_test_data_employee table by using sql query.

$temp_employee_object_array = Test_Data_Employee::find_by_sql("SELECT * FROM wb_test_data_employee WHERE id=5");

$temp_employee_object = array_shift($temp_employee_object_array);

if($temp_employee_object->first_name == "Eliza" && $temp_employee_object->last_name == "Clifford"){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test find_by_sql() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test find_by_sql() FAILED";
	echo "</div>";
}

unset($temp_employee_object_array);
unset($temp_employee_object);
</xmp>
</div>
<?php 
//Test database table wb_test_data_employee contains 8 row of data.
//Id 5 is Eliza Cliford. This test will create a Test_Data_Employee object
//out of row that have the id=5 from wb_test_data_employee table by using sql query.

$temp_employee_object_array = Test_Data_Employee::find_by_sql("SELECT * FROM wb_test_data_employee WHERE id=5");

$temp_employee_object = array_shift($temp_employee_object_array);

if($temp_employee_object->first_name == "Eliza" && $temp_employee_object->last_name == "Clifford"){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test find_by_sql() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test find_by_sql() FAILED";
	echo "</div>";
}

unset($temp_employee_object_array);
unset($temp_employee_object);
?>

<h3 class="expand sub-header">Test count_all()</h3>
<div class="well" style="display:none;">
<xmp>
//Test database table wb_test_data_employee contains 8 row of data.

$count = Test_Data_Employee::count_all();

if($count == 8){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test count_all() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test count_all() FAILED";
	echo "</div>";
}
</xmp>
</div>
<?php 
//Test database table wb_test_data_employee contains 8 row of data.

$count = Test_Data_Employee::count_all();

if($count == 8){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test count_all() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test count_all() FAILED";
	echo "</div>";
}
?>

<h3 class="expand sub-header">Test count_all_where($condition)</h3>
<div class="well" style="display:none;">
<xmp>
//Test database table wb_test_data_employee contains 8 row of data.
//id=5 from wb_test_data_employee table count should be one.

$count = Test_Data_Employee::count_all_where("id=5");

if($count == 1){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test count_all_where(\$condition) PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test count_all_where(\$condition) FAILED";
	echo "</div>";
}
</xmp>
</div>
<?php 
//Test database table wb_test_data_employee contains 8 row of data.
//id=5 from wb_test_data_employee table count should be one.

$count = Test_Data_Employee::count_all_where("id=5");

if($count == 1){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test count_all_where(\$condition) PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test count_all_where(\$condition) FAILED";
	echo "</div>";
}
?>

<h3 class="expand sub-header">Test create()</h3>
<div class="well" style="display:none;"><xmp></xmp></div>
<?php 
//Create new object
$temp_employee_object = new Test_Data_Employee();

//Count the rows in the table
$count_before = Test_Data_Employee::count_all();

//Set all atributes of the object
$temp_employee_object->first_name = 'John';
$temp_employee_object->last_name = 'Dow';
$temp_employee_object->job_title = 'Programmer';
$temp_employee_object->salary = 1000;

$temp_employee_object->create();

//Count the rows in the table
$count_after = Test_Data_Employee::count_all();

if($count_after == ($count_before + 1)){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test create() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test create() FAILED";
	echo "</div>";
}
?>
<!-- display table  -->
<p class="expand"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> &nbsp; Show table</p>
<div class="well" style="display:none;">
<?php
//show wb_test_data_employee table and all the rows 
 $result = $database->query("SELECT * FROM wb_test_data_employee");
 if ($database->num_rows($result)>0){
	 $r = mysqli_fetch_array($result,MYSQL_ASSOC);
	 $table="<table  class='table table-striped table-bordered'><tr>";
	 $firstLine="<tr>";
 foreach ($r as $k => $v){
   $table .="<th>".$k."</th>";
   $firstLine .="<td>".$v."</td>";
 }
 $table.="</tr>".$firstLine."</tr>";
 while($r = mysqli_fetch_array($result,MYSQL_ASSOC)){
   $table.="<tr>";
   foreach($r as $k => $v)
     $table.="<td>".$v."</td>";
   $table.="</tr>";
 }
  $table .="</table>";
 echo $table;
}
?>
</div>

<h3 class="expand sub-header">Test update()</h3>
<div class="well" style="display:none;"><xmp></xmp></div>
<?php 
$temp_employee_object_array = Test_Data_Employee::find_by_sql("SELECT * FROM wb_test_data_employee WHERE first_name='John'");

$temp_employee_object = array_shift($temp_employee_object_array);

$temp_employee_object->first_name = 'Jane';

$temp_employee_object->update();

$temp_employee_object_array = Test_Data_Employee::find_by_sql("SELECT * FROM wb_test_data_employee WHERE first_name='Jane'");

$temp_employee_object = array_shift($temp_employee_object_array);

if($temp_employee_object->first_name == "Jane"){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test find_by_sql() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test find_by_sql() FAILED";
	echo "</div>";
}

unset($temp_employee_object_array);
unset($temp_employee_object);
?>
<!-- display table  -->
<p class="expand"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> &nbsp; Show table</p>
<div class="well" style="display:none;">
<?php
//show wb_test_data_employee table and all the rows 
 $result = $database->query("SELECT * FROM wb_test_data_employee");
 if ($database->num_rows($result)>0){
	 $r = mysqli_fetch_array($result,MYSQL_ASSOC);
	 $table="<table  class='table table-striped table-bordered'><tr>";
	 $firstLine="<tr>";
 foreach ($r as $k => $v){
   $table .="<th>".$k."</th>";
   $firstLine .="<td>".$v."</td>";
 }
 $table.="</tr>".$firstLine."</tr>";
 while($r = mysqli_fetch_array($result,MYSQL_ASSOC)){
   $table.="<tr>";
   foreach($r as $k => $v)
     $table.="<td>".$v."</td>";
   $table.="</tr>";
 }
  $table .="</table>";
 echo $table;
}
?>
</div>

<h3 class="expand sub-header">Test delete()</h3>
<div class="well" style="display:none;"><xmp></xmp></div>
<?php 
$temp_employee_object_array = Test_Data_Employee::find_by_sql("SELECT * FROM wb_test_data_employee WHERE first_name='Jane'");

$temp_employee_object = array_shift($temp_employee_object_array);

$temp_employee_object->delete();

$count = Test_Data_Employee::count_all();

if($count == 8){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test delete() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test delete() FAILED";
	echo "</div>";
}
?>
<!-- display table  -->
<p class="expand"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> &nbsp; Show table</p>
<div class="well" style="display:none;">
<?php
//show wb_test_data_employee table and all the rows 
 $result = $database->query("SELECT * FROM wb_test_data_employee");
 if ($database->num_rows($result)>0){
	 $r = mysqli_fetch_array($result,MYSQL_ASSOC);
	 $table="<table  class='table table-striped table-bordered'><tr>";
	 $firstLine="<tr>";
 foreach ($r as $k => $v){
   $table .="<th>".$k."</th>";
   $firstLine .="<td>".$v."</td>";
 }
 $table.="</tr>".$firstLine."</tr>";
 while($r = mysqli_fetch_array($result,MYSQL_ASSOC)){
   $table.="<tr>";
   foreach($r as $k => $v)
     $table.="<td>".$v."</td>";
   $table.="</tr>";
 }
  $table .="</table>";
 echo $table;
}
?>
</div>

<?php
include('footer.html');
?>