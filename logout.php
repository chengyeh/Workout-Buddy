<?php
/*
 *	@file logout.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments log out the user from the site.
*/

//object buffering start
ob_start();

//Include initialization file
require_once('includes/initialize.php');

//If user is not logon redirect to login page
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Logout the user
$session->logout();

//Redirect
redirect_to("login.php");
?>
