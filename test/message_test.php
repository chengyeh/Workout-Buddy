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

	<h3 class="sub-header">Test for receive message</h3>
<p>This test will test if a message can be sent from a user.</p>
&nbsp;
<p>Following code will test how a user can receive a message by viewing it in their inbox:</p>
<div class="well">
	<xmp>
	  //The following function is found in includes/user.php
	  //The receiver id will be 9, which is the receiver id of the message sent in the previous test
	  //The same message sent from the previous test will be observed here
	  public function receive_messages()
      {
    	global $database;
    	$a=0;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$this->id." AND del_receive=".$a;
    	$group_message_array = $database->query($sql);
    	return $group_message_array;
      }

      //Functionality used to query the user name from the user column in users table
      //This is used to convert the sent or "user" id to an actual name
      //The name of the individual who is sending this message is Santosh Charles
      $t=User::find_by_id($message1['user']);
	  echo "<td>" . $t->full_name()."</td>";


	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php
		$id1 = 9;
    	global $database;
    	$a=0;
    	$sql2 = "SELECT * FROM wb_messages WHERE receiver=".$id1." AND del_receive=".$a;
    	$group_message_array = $database->query($sql2);
      	$inbox_array;
      	$t;
		while($receive_array = $group_message_array->fetch_assoc())
		{

					if($receive_array['id']==$pm->id)
					{

						$inbox_array=Message::find_by_id($receive_array['id']);
						echo "<br>";
						echo "<strong>Message in Inbox: </strong>";
						echo $inbox_array->message;
						echo "<br>";
						echo "<strong>Date the message was received: </strong>";
						echo $inbox_array->Date;
						echo "<br>";
						echo "<strong>Time the  message was received (US/CST): </strong>";
						echo $inbox_array->Time;
						echo "<br>";
						$t=User::find_by_id($receive_array['user']);
						echo "<strong>Message was sent from: </strong>";
	  					echo $t->full_name();
					}

		}
	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php

		global $database;
    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$pm->receiver;
    	$group_member_array = $database->query($sql);
    	$pass_trigger=1;
    	while($log_array = $group_member_array->fetch_assoc())
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
					if(($v->full_name())!=$t->full_name())
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
