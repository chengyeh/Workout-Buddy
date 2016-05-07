<?php 
/*
 *	@file calendar_start.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Display event details from calendar.
*/

// Include initialization file
require_once('includes/initialize.php');

//get event date from POST array
$deets = $_POST['deets'];

//format the date
$deets = preg_replace('#[^0-9-]#i','',$deets);

//Store event variable
$events = '';

//Query database for event details
$result = $database->query("SELECT id, name FROM wb_event_calendar WHERE user_id={$session->user_id} AND event_date LIKE '%{$deets}%'");
$num_rows = $result->num_rows;

//If event detail exits
if ($num_rows > 0) {
	//concat event details 
	$events .= '<div id="eventsControl style="display: block;"><button class="btn btn-info" onMouseDown="overlay();">Close</button><br/><br/><b>'.$deets.'</b><br/><br/></div>';
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$events .= '<div id="eventsBody" style="display: block;"><a href="show_calendar_event.php?id='.$row["id"].'">'.$row['name'].'</a><br/><hr><br/></div>';
	}
}

//Show event details
echo $events;
?>