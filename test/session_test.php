<?php 
require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Session Testing</h1>
<p>This seris of test will test the Session class and it's methods.</p>

<h3 class="expand sub-header">Test is_logged_in()</h3>
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

<h3 class="expand sub-header">Test login($user)</h3>
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

<h3 class="expand sub-header">Test logout()</h3>
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

<h3 class="expand sub-header">Test message($msg="")</h3>
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

<h3 class="expand sub-header">Test check_login()</h3>
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

<h3 class="expand sub-header">Test check_message()</h3>
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