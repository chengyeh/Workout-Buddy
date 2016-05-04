<?php 
require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Pagination Testing</h1>
<p>This seris of test will test the Pagination class and it's methods.</p>

<h3 class="expand sub-header">Test offset()</h3>
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

<h3 class="expand sub-header">Test total_pages()</h3>
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

<h3 class="expand sub-header">Test previous_page()</h3>
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

<h3 class="expand sub-header">Test next_page()</h3>
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

<h3 class="expand sub-header">Test has_previous_page()</h3>
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

<h3 class="expand sub-header">Test has_next_page()</h3>
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