<?php 
/*
*	@file session_test.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments This file will run all the test for the session class.
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('../includes/initialize.php');
?>

<?php 
include('header.html');
?>

<!-- html goes here -->
<h1 class="page-header">Session Testing</h1>
<p>This seris of test will test <b>public</b> functions in Session class.</p>

<h3 class="expand sub-header">Test login($user)</h3>
<div class="well" style="display:none;"><p>Please see session_test.php file for the test code.</p></div>
<?php 
//To test login
//1. create session object
//2. create user object
//3. login in the user by calling login
//4. Verfiy by assessing $_SESSION[] global variable

//unset and destroy any session variables that already created;
session_unset();
session_destroy();

//craete session object
$session_object = new Session();

//create user object
$user = new User();

//define all user attributes
$user->id = 18;
$user->first_name = 'foo';

//Call login($user) to log the user in
$session_object->login($user);

//get the user id from the session variable
$result = $_SESSION['user_id'];

//check id is 18
if($result == 18){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test login(\$user) PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test login(\$user) FAILED";
	echo "</div>";
}
?>

<h3 class="expand sub-header">Test is_logged_in()</h3>
<div class="well" style="display:none;">
<xmp>
//Use session and user object from the previous test.
//Note: Unable call session_start() again in the same page, reuser
//objects from previous test.

//check id is 18
if($session_object->is_logged_in()){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test is_logged_in() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test is_logged_in() FAILED";
	echo "</div>";
}
</xmp>
</div>
<?php 
//Use session and user object from the previous test.
//Note: Unable call session_start() again in the same page, reuser
//objects from previous test.

//check id is 18
if($session_object->is_logged_in()){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test is_logged_in() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test is_logged_in() FAILED";
	echo "</div>";
}
?>

<h3 class="expand sub-header">Test message($msg="")</h3>
<div class="well" style="display:none;">
<xmp>
//Use session object from the previous test.
//Note: Unable call session_start() again in the same page, reuser
//objects from previous test.

//message used for testing
$msg = "This is the message!";

//call message($msg="") with "This is the message!"
$session_object->message($msg);

//Test is perform to chech the message in passed on to the
//message($msg="") is the same as the $_SESSION['message']
//global variable

//Check  $_SESSION['message'] global variable
if($_SESSION['message'] == $msg){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test message(\$msg=\"\") PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test message(\$msg=\"\") FAILED";
	echo "</div>";
}
</xmp>
</div>
<?php 
//Use session object from the previous test.
//Note: Unable call session_start() again in the same page, reuser
//objects from previous test.

//message used for testing
$msg = "This is the message!";

//call message($msg="") with "This is the message!"
$session_object->message($msg);

//Test is perform to chech the message in passed on to the
//message($msg="") is the same as the $_SESSION['message']
//global variable

//Check  $_SESSION['message'] global variable
if($_SESSION['message'] == $msg){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test message(\$msg=\"\") PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test message(\$msg=\"\") FAILED";
	echo "</div>";
}
?>

<h3 class="expand sub-header">Test logout()</h3>
<div class="well" style="display:none;">
<xmp>
//Use session object from the previous test.
//Note: Unable call session_start() again in the same page, reuser
//objects from previous test.

//call logout()
$session_object->logout();

//Check session variable is empty
if(empty($_SESSION['user_id'])){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test logout() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test logout() FAILED";
	echo "</div>";
}
</xmp>
</div>
<?php 
//Use session object from the previous test.
//Note: Unable call session_start() again in the same page, reuser
//objects from previous test.

//call logout()
$session_object->logout();

//Check session variable is empty
if(empty($_SESSION['user_id'])){
	echo "<div class='well' style='background-color: #b3ffcc'>";
	echo "Test logout() PASSED";
	echo "</div>";
}else {
	echo "<div class='well' style='background-color: #ffd6cc'>";
	echo "Test logout() FAILED";
	echo "</div>";
}
?>

<?php
include('footer.html');
?>