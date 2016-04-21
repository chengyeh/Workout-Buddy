<?php
/**
 * When User clicks on a group, all members of the group and the groups activity are queried from he database and printed in a table. If the user id matches that of the owner of the group, adminstrative priveleges are granted and the owner can delete members.
 * 
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
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
	$event->delete();
	redirect_to('show_calendar.php');
}else{
	$session->message("Unable to be find event.");
	redirect_to('show_calendar.php');
}
	
?>