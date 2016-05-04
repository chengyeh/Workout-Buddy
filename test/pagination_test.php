<?php 
/*
 *	@file pagination_test.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Test pagination class public functions.
*/

require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Pagination Testing</h1>
<p>This seris of test will test <b>public</b> functions in Pagination class.</p>


<h3 class="expand sub-header">Test offset()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call offset()
$result = $pagination_object->offset();

//If at page 4, the offset should be 60.
//Given the per page=20 and total number = 100

//Ckeck if the offset 60
if($result == 60){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test offset() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test offset() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call offset()
$result = $pagination_object->offset();

//If at page 4, the offset should be 60.
//Given the per page=20 and total number = 100

//Ckeck if the offset 60
if($result == 60){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test offset() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test offset() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<h3 class="expand sub-header">Test total_pages()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call total_pages()
$result = $pagination_object->total_pages();

//Object was created with total number of rows = 100
//and per page =20, therefore total pages = 100/20 = 5.

//Ckeck if the total_pages() = 5
if($result == 5){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test total_pages() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test total_pages() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call total_pages()
$result = $pagination_object->total_pages();

//Object was created with total number of rows = 100
//and per page =20, therefore total pages = 100/20 = 5.

//Ckeck if the total_pages() = 5
if($result == 5){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test total_pages() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test total_pages() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<h3 class="expand sub-header">Test previous_page()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call previous_page()
$result = $pagination_object->previous_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//previous_page() should return 3

//Ckeck if the previous_page() = 3
if($result == 3){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test previous_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test previous_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call previous_page()
$result = $pagination_object->previous_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//previous_page() should return 3

//Ckeck if the previous_page() = 3
if($result == 3){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test previous_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test previous_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<h3 class="expand sub-header">Test next_page()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call next_page()
$result = $pagination_object->next_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//next_page() should return 5

//Ckeck if the next_page() = 5
if($result == 5){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test next_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test next_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call next_page()
$result = $pagination_object->next_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//next_page() should return 5

//Ckeck if the next_page() = 5
if($result == 5){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test next_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test next_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<h3 class="expand sub-header">Test has_previous_page()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call has_previous_page()
$result = $pagination_object->has_previous_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//has_previous_page() should return TRUE

//Ckeck if the has_previous_page() = TRUE
if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_previous_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_previous_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call has_previous_page()
$result = $pagination_object->has_previous_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//has_previous_page() should return TRUE

//Ckeck if the has_previous_page() = TRUE
if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_previous_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_previous_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<h3 class="expand sub-header">Test has_previous_page() [Lower bound test]</h3>
<div class="well" style="display:none;">
<xmp>
//This will test the boader case if total pages are 5
//and the current page is 1

//Create instance of pagination class with 
//current page = 1
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(1,20,100);

//Call has_previous_page()
$result = $pagination_object->has_previous_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 1.
//has_previous_page() should return FALSE

//Ckeck if the has_previous_page() = FALSE
if(!$result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_previous_page() [Lower bound test] PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_previous_page() [Lower bound test] FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//This will test the boader case if total pages are 5
//and the current page is 1

//Create instance of pagination class with 
//current page = 1
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(1,20,100);

//Call has_previous_page()
$result = $pagination_object->has_previous_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 1.
//has_previous_page() should return FALSE

//Ckeck if the has_previous_page() = FALSE
if(!$result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_previous_page() [Lower bound test] PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_previous_page() [Lower bound test] FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<h3 class="expand sub-header">Test has_next_page()</h3>
<div class="well" style="display:none;">
<xmp>
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call has_next_page()
$result = $pagination_object->has_next_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//has_next_page() should return TRUE

//Ckeck if the has_next_page() = TRUE
if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_next_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_next_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//Create instance of pagination class with 
//current page = 4
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(4,20,100);

//Call has_next_page()
$result = $pagination_object->has_next_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 4.
//has_next_page() should return TRUE

//Ckeck if the has_next_page() = TRUE
if($result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_next_page() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_next_page() FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<h3 class="expand sub-header">Test has_next_page() [Upper bound test]</h3>
<div class="well" style="display:none;">
<xmp>
//This will test the boader case if total pages are 5
//and the current page is 5

//Create instance of pagination class with 
//current page = 5
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(5,20,100);

//Call has_next_page()
$result = $pagination_object->has_next_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 5.
//has_next_page() should return FALSE

//Ckeck if the has_next_page() = FALSE
if(!$result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_next_page() [Upper bound test] PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_next_page() [Upper bound test] FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
</xmp>
</div>
<?php 
//This will test the boader case if total pages are 5
//and the current page is 5

//Create instance of pagination class with 
//current page = 5
//rows per page = 20
//total number of rows = 100
$pagination_object = new Pagination(5,20,100);

//Call has_next_page()
$result = $pagination_object->has_next_page();

//Object was created with total number of rows = 100,
//per page =20, and current page = 5.
//has_next_page() should return FALSE

//Ckeck if the has_next_page() = FALSE
if(!$result){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test has_next_page() [Upper bound test] PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test has_next_page() [Upper bound test] FAILED";
	echo "</div>";
}

//unset all the variables
unset($pagination_objec);
unset($result);
?>

<?php
include('footer.html');
?>