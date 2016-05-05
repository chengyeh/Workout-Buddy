<?php
/*
*	@file calendar_start.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Delete calendar event from database.
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

// Include initialization file
require_once('includes/initialize.php');

//If user is not logon redirect to login page
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
	$session->message("No event ID was provided.");
	redirect_to('show_calendar.php');
}

//Create Group object from ID in the URL 
$event = Event_Calendar::find_by_id($_GET['id']);
if($event){
	//event found. delete event.
	$event->delete();
	redirect_to('show_calendar.php');
}else{
	//event not found. redirect.
	$session->message("Unable to be find event.");
	redirect_to('show_calendar.php');
}
	
?>