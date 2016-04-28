<?php 
require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Database Testing</h1>
<p>This seris of test will test the database class and it's methods.</p>
<p>To test the the database class a isntance of the class is created and test with 
comparison to regular php msqli functions</p>

<h3 class="sub-header">Test open_connection()</h3>
<p>This test will test the connection to the database.</p>
&nbsp;
<p>Following code will test the connection with mysqli.</p>
<div class="well">
	<xmp>
	$dbname = 'pdoddapa';
	$dbuser = 'pdoddapa';
	$dbpass = 'password123';
	$dbhost = 'mysql.eecs.ku.edu';
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	$test_query = "SHOW TABLES FROM $dbname";
	$result = mysql_query($test_query);
	$tblCnt = 0;
	while($tbl = mysql_fetch_array($result)) {
	  $tblCnt++;
	  #echo $tbl[0]."<br />\n";
	}
	if (!$tblCnt) {
	  echo "There are no tables<br />\n";
	} else {
	  echo "There are $tblCnt tables<br />\n";
	}
	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php
	# Fill our vars and run on cli
	# $ php -f db-connect-test.php
	$dbname = 'pdoddapa';
	$dbuser = 'pdoddapa';
	$dbpass = 'password123';
	$dbhost = 'mysql.eecs.ku.edu';
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	$test_query = "SHOW TABLES FROM $dbname";
	$result = mysql_query($test_query);
	$tblCnt = 0;
	while($tbl = mysql_fetch_array($result)) {
	  $tblCnt++;
	  #echo $tbl[0]."<br />\n";
	}
	if (!$tblCnt) {
	  echo "There are no tables<br />\n";
	} else {
	  echo "There are $tblCnt tables<br />\n";
	}
	?>
</div>

<p>Following code will test the connection with database object.</p>
<div class="well">
<xmp>
$database = new MySQLDatabase();
$database->open_connection();
print_r($database);
</xmp>
</div>

<p>Result:</p>
<?php 
$database = new MySQLDatabase();
$database->open_connection();
echo "<pre style='background-color: #e6f7ff;'>";
print_r($database);
echo "</pre>";
?>

<h3 class="sub-header">Test close_connection()</h3>
<h3 class="sub-header">Test query($sql)</h3>
<h3 class="sub-header">Test escape_value($value)</h3>
<h3 class="sub-header">Test fetch_array($result_set)</h3>
<h3 class="sub-header">Test num_rows($result_set)</h3>
<h3 class="sub-header">Test insert_id()</h3>
<h3 class="sub-header">Test affected_rows()</h3>
<h3 class="sub-header">Test confirm_query($result)</h3>
<?php
include('footer.html');
?>