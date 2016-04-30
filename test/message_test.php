<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Message Testing</h1>
<h3 class="sub-header">Test for send message</h3>
<p>This test will test if a message can be sent from a user.</p>
&nbsp;
<p>Following code will test whether it can send a query from a designated message.</p>
<div class="well">
<xmp>

	date_default_timezone_set('America/Chicago');
    $dt = new DateTime();
	$tz = new DateTimeZone('America/Chicago');
	$pm = new Message();
    $pm->user = $trimmed['user_id'];
    //Have the $user_id=5
    $pm->receiver = $view_user->id;
    //Have the $view_user->id = 9
    $pm->message = $trimmed['message'];
    //Let's have the message be: "Let's play tennis on Friday!"
	$pm->Date = $dt->format('m-d-Y');
	//Date will be today's date
    $pm->Time = $dt->format('H:i:s');
    //Time will be the immediate time
    $pm->create();

	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php
	date_default_timezone_set('America/Chicago');
    $dt = new DateTime();
	$tz = new DateTimeZone('America/Chicago');

	$pm = new Message();
    $pm->user = 5;

    $pm->user->receiver =9;
    $pm->user = 5;
    $pm->receiver = 9;
    $pm->message = "Let's play tennis on Friday!";
    $pm->Date = $dt->format('m-d-Y');
    $pm->Time = $dt->format('H:i:s');
    $pm->create();





    	global $database;
    	$sql = "SELECT * FROM wb_messages WHERE id=".$pm->id;
    	$group_member_array = $database->query($sql);
    	echo "<strong>The message that was queried : </strong>";
    	while($log_array = $group_member_array->fetch_assoc())
		{

					$set_array=Message::find_by_id($log_array['id']);

					echo "<br>";
					echo "<strong>User id sent: </strong>";
					echo $set_array->user;
					echo "<br>";
					echo "<strong>Receiver id sent: </strong>";
					echo $set_array->receiver;
					echo "<br>";
					echo "<strong>Message sent: </strong>";
					echo $set_array->message;
					echo "<br>";
					echo "<strong>Time message was sent (US/CST): </strong>";
					echo $set_array->Time;
					echo "<br>";
					echo "<strong>Date message was sent: </strong>";
					echo $set_array->Date;
		}


	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php

    	global $database;
    	$sql = "SELECT * FROM wb_messages WHERE id=".$pm->id;
    	$group_member_array = $database->query($sql);
    	$pass_trigger=1;
    	while($log_array = $group_member_array->fetch_assoc())
		{

					$set_array=Message::find_by_id($log_array['id']);
					if(($set_array->user)!=$pm->user)
					{
						$pass_trigger=0;
					}

					if(($set_array->receiver)!=$pm->receiver)
					{
						$pass_trigger=0;
					}
					if(($set_array->message)!=$pm->message)
					{
						$pass_trigger=0;
					}
					if(($set_array->Date)!=$pm->Date)
					{
						$pass_trigger=0;
					}
					if(($set_array->Time)!=$pm->Time)
					{
						$pass_trigger=0;
					}

		}
		if($pass_trigger==1)
		{
			echo "<strong>Passed</strong>";
		}
		else
		{
			echo "<strong>Failed</strong>";
		}


	?>
	</div>

<?php
include('footer.html');
?>
