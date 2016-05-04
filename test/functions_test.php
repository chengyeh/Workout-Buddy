<?php 
/*
 *	@file functions_test.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Test functions.php functions .
*/

require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Functions Testing</h1>
<p>This seris of test will test functions in helper functions file functions.php.</p>

<h3 class="expand sub-header">Test __autoload($class_name)</h3>
<div class="well" style="display:none;"><xmp></xmp></div>
<?php 
$result;

if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test  PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test  FAILED";
	echo "</div>";
}
?>

<h3 class="expand sub-header">Test redirect_to($location = NULL)</h3>
<div class="well" style="display:none;"><xmp></xmp></div>
<?php 
$result;

if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test  PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test  FAILED";
	echo "</div>";
}
?>

<?php
include('footer.html');
?>