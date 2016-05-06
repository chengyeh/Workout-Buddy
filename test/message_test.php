<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Message Testing</h1>

<h3 class="expand sub-header">Test for send message</h3>
<div class="well" style="display:none;">
<xmp>


	//This test will test if a message can be sent from a user.
	//Following code will test whether it can send a query from a designated message.
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

    date_default_timezone_set('America/Chicago');
    $dt = new DateTime();
	$tz = new DateTimeZone('America/Chicago');

	$pm = new Message();


    $pm->user = 5;
    $pm->receiver = 9;
    $pm->message = "Let's play tennis on Friday!";
    $pm->Date = $dt->format('m-d-Y');
    $pm->Time = $dt->format('H:i:s');
    $pm->create();

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
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}

	</xmp>
</div>


	<?php
	date_default_timezone_set('America/Chicago');
    $dt = new DateTime();
	$tz = new DateTimeZone('America/Chicago');

	$pm = new Message();


    $pm->user = 5;
    $pm->receiver = 9;
    $pm->message = "Let's play tennis on Friday!";
    $pm->Date = $dt->format('m-d-Y');
    $pm->Time = $dt->format('H:i:s');
    $pm->create();

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
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}






	?>


	<h3 class="expand sub-header">Test to receive message</h3>

<div class="well" style="display:none;">
	<xmp>
	  	global $database;
    	$a=0;
    	$sql2 = "SELECT * FROM wb_messages WHERE receiver=".$pm->receiver." AND del_receive=".$a;
    	$group_message_array = $database->query($sql2);
      	$pass_trigger=1;
    	while($log_array = $group_message_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					$v=User::find_by_id($log_array['user']);
					if(($set_array->message)!=$pm->message)
					{
						$pass_trigger=0;
					}

					if(($set_array->receiver)!=$pm->receiver)
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


		}
		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}


	</xmp>
</div>

	<?php

    		global $database;
    	$a=0;
    	$sql2 = "SELECT * FROM wb_messages WHERE receiver=".$pm->receiver." AND del_receive=".$a;
    	$group_message_array = $database->query($sql2);
      	$pass_trigger=1;
    	while($log_array = $group_message_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					$v=User::find_by_id($log_array['user']);
					if(($set_array->message)!=$pm->message)
					{
						$pass_trigger=0;
					}

					if(($set_array->receiver)!=$pm->receiver)
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


		}
		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>



	<h3 class="expand sub-header">Test for deleting messages from inbox</h3>

<div class="well" style="display:none;">
	<xmp>
	  global $database;
		$database->query("UPDATE wb_messages SET del_receive = 1 WHERE id = ".$pm->id);



		global $database;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$pm->receiver;
    	$group_member_array = $database->query($sql);
    	$del_rec_trans;
    	while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					$del_rec_trans=$set_array->del_receive;

				}

		}


		if(($del_rec_trans)==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}


	</xmp>
</div>

	<?php

    	global $database;
		$database->query("UPDATE wb_messages SET del_receive = 1 WHERE id = ".$pm->id);



		global $database;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$pm->receiver;
    	$group_member_array = $database->query($sql);
    	$del_rec_trans;
    	while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					$del_rec_trans=$set_array->del_receive;

				}

		}


		if(($del_rec_trans)==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>

	<h3 class="expand sub-header">Test for deleting messages from sent</h3>

<div class="well" style="display:none;">
	<xmp>
	  global $database;
		$database->query("UPDATE wb_messages SET del_sent = 1 WHERE id = ".$pm->id);

    	echo "<strong>The del_sent value is: </strong>";

		global $database;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$pm->receiver;
    	$group_member_array = $database->query($sql);
    	$del_sent_trans;
    	while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					$del_sent_trans=$set_array->del_sent;
					echo $set_array->del_sent;
				}

		}

		echo "<br>";
		if(($del_sent_trans)==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}





	</xmp>
</div>

	<?php

    	global $database;
		$database->query("UPDATE wb_messages SET del_sent = 1 WHERE id = ".$pm->id);



		global $database;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$pm->receiver;
    	$group_member_array = $database->query($sql);
    	$del_sent_trans;
    	while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					$del_sent_trans=$set_array->del_sent;

				}

		}


		if(($del_sent_trans)==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>

<h3 class="expand sub-header">Test for deleting messages from sent</h3>

<div class="well" style="display:none;">
	<xmp>

		$database->query("UPDATE `wb_messages` SET `read_message`=1 WHERE `id`=".$pm->id);


	    global $database;
    	$sql = "SELECT * FROM wb_messages WHERE id=".$pm->id;
    	$group_member_array = $database->query($sql);
	    while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					if(($set_array->read_message)==1)
					{
						echo "<div class='well' style='background-color: #b3ffcc'>";
						echo "<strong>PASSED</strong>";
						echo "</div>";
					}
					else
					{
						echo "<div class='well' style='background-color: #ffd6cc'>";
						echo "<strong>FAILED</strong>";
						echo "</div>";
					}
				}
		}
	</xmp>
</div>

	<?php
		$database->query("UPDATE `wb_messages` SET `read_message`=1 WHERE `id`=".$pm->id);


	    global $database;
    	$sql = "SELECT * FROM wb_messages WHERE id=".$pm->id;
    	$group_member_array = $database->query($sql);
	    while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					if(($set_array->read_message)==1)
					{
						echo "<div class='well' style='background-color: #b3ffcc'>";
						echo "<strong>PASSED</strong>";
						echo "</div>";
					}
					else
					{
						echo "<div class='well' style='background-color: #ffd6cc'>";
						echo "<strong>FAILED</strong>";
						echo "</div>";
					}
				}
		}

	?>

	<?php

		$pm->delete();

	?>

<?php
include('footer.html');
?>
