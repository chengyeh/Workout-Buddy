<?php
// Workout Buddy Manual
// 
//    
// Copyright (C) <2016>  <Paul Charles, Kuei-Hsien Chu, Purna Doddapaneni, Dilesh Fernando, Cheng-Yeh Lee>
// 
// This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
// 
// You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
?>
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