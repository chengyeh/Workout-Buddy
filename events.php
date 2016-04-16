<?php 
require_once('includes/initialize.php');

$deets = $_POST['deets'];
$deets = preg_replace('#[^0-9-]#i','',$deets);

$events = '';
$result = $database->query("SELECT description FROM wb_event_calendar WHERE user_id={$session->user_id} AND event_date LIKE '%{$deets}%'");
$num_rows = $result->num_rows;
if ($num_rows > 0) {
	$events .= '<div id="eventsControl style="display: block;"><button class="btn btn-info" onMouseDown="overlay();">Close</button><br/><br/><b>'.$deets.'</b><br/><br/></div>';
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$desc = $row['description'];
		$events .= '<div id="eventsBody" style="display: block;">'.$desc.'<br/><hr><br/></div>';
	}
}

echo $events;

?>