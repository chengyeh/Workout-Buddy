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
$database2 = new MySQLDatabase();
$result = $database2->query("SELECT * FROM wb_users");
if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test query(\$sql) PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test query(\$sql) FAILED";
	echo "</div>";
}
?>
<h3 class="sub-header">Test escape_value($value)</h3>
<h3 class="sub-header">Test fetch_array($result_set)</h3>
<h3 class="sub-header">Test num_rows($result_set)</h3>
<h3 class="sub-header">Test insert_id()</h3>
<h3 class="sub-header">Test affected_rows()</h3>
<h3 class="sub-header">Test confirm_query($result)</h3>
<?php
include('footer.html');
?>