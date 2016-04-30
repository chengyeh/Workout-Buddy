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

	<h3 class="sub-header">Test for deleting messages from inbox</h3>
<p>This test will test how a message can no longer be viewed from the inbox.</p>
&nbsp;
<p>Following code will test how a user can delete a message from their inbox:</p>
<div class="well">
	<xmp>
	  //The following functionality is found in inbox.php
	  //This functionality is used more for front end, in which the array checkbox delete_message[] is triggered to delete

	  //The same message sent from the previous test will be observed here
	 $t=User::find_by_id($message1['user']);

				echo "<td>" . $t->full_name()."</td>";
				echo "<td>" . $message1['message'] . "</td>";
				echo "<td>" . $message1['Time'] . "</td>";
				echo "<td>" . $message1['Date'] . "</td>";
				echo "<td class='text-center'><input type='checkbox' name='delete_message[]' value='" . $message1["id"] . "'></td>";


       //The del_receive id will be triggered in order to remove the viewing from the front end.
       //The default value for del_receive is 0. If the user doesn't want to view this they trigger the checkbox and the del_receive value is 1.
       //Therefore, only messages that have a del_receive value of 0 can be viewed. However the data is still in the database
       //The messages are still in the database phpMyAdmin, so this is a creative way to delete messages apart from traditionally using a delete sql keyword
       //This is also backend execution of the function
		if(!empty($_POST['delete_message']))
    {
        foreach($_POST['delete_message'] as $message_id)
        {
        	$value=1;
            $database->query("UPDATE wb_messages SET del_receive = 1 WHERE id = ".$message_id);
        }
    }


	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php
		global $database;
		$database->query("UPDATE wb_messages SET del_receive = 1 WHERE id = ".$pm->id);

    	echo "<strong>The del_receive value is: </strong>";

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
					echo $set_array->del_receive;
				}

		}

		echo "<br>";
		if(($del_rec_trans)==1)
		{
			echo "<strong>Since the del_receive value is 1, the user can no longer view it </strong>";
		}
		else
		{
			echo "<strong>The del_receive value is still 0, the message is not deleted </strong>";
		}

	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php


    	if(($del_rec_trans)==1)
		{
			echo "<strong>Passed </strong>";
		}
		else
		{
			echo "<strong>Failed</strong>";
		}


	?>
	</div>

	<h3 class="sub-header">Test for deleting messages from Sent box</h3>
<p>This test will test how a message can no longer be viewed from the Sent box.</p>
&nbsp;
<p>Following code will test how a user can delete a message from their Sent box:</p>
<div class="well">
	<xmp>
	  //The following functionality is found in sent.php
	  //This functionality is used more for front end, in which the array checkbox delete_message[] is triggered to delete

	  //The same message sent from the previous test will be observed here
	 $t=User::find_by_id($message1['user']);

				echo "<td>" . $t->full_name()."</td>";
				echo "<td>" . $message1['message'] . "</td>";
				echo "<td>" . $message1['Time'] . "</td>";
				echo "<td>" . $message1['Date'] . "</td>";
				echo "<td class='text-center'><input type='checkbox' name='delete_message[]' value='" . $message1["id"] . "'></td>";


       //The del_sent id will be triggered in order to remove the viewing from the front end.
       //The default value for del_sent is 0. If the user doesn't want to view this they trigger the checkbox and the del_sent value is 1.
       //Therefore, only messages that have a del_sent value of 0 can be viewed. However the data is still in the database
       //The messages are still in the database phpMyAdmin, so this is a creative way to delete messages apart from traditionally using a delete sql keyword
       //This is also backend execution of the function
		if(!empty($_POST['delete_message']))
    {
        foreach($_POST['delete_message'] as $message_id)
        {
        	$value=1;
            $database->query("UPDATE wb_messages SET del_sent = 1 WHERE id = ".$message_id);
        }
    }


	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php
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
			echo "<strong>Since the del_sent value is 1, the sender can no longer view it </strong>";
		}
		else
		{
			echo "<strong>The del_sent value is still 0, the sentmessage is not deleted </strong>";
		}

	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php


    	if(($del_sent_trans)==1)
		{
			echo "<strong>Passed </strong>";
		}
		else
		{
			echo "<strong>Failed</strong>";
		}


	?>
	</div>







		<h3 class="sub-header">Test for Message Icon Trigger</h3>
<p>This test will test how to trigger symbol on the navigation bar to display and not display when the user views messages in the Inbox .</p>
&nbsp;
<p>Following code displays the functionality to trigger this symbol and display the number of messages that need to be viewed in the inbox:</p>
<div class="well">
	<xmp>
	  //The following functionality is found in inbox.php
	  //This is viewed to show the
		$result_set = $database->query("SELECT * FROM wb_messages WHERE read_message=0 AND receiver=".$user->id);
	    $number_messages = $database->num_rows($result_set);


       //The del_sent id will be triggered in order to remove the viewing from the front end.
       //The default value for del_sent is 0. If the user doesn't want to view this they trigger the checkbox and the del_receive value is 1.
       //Therefore, only messages that have a del_sent value of 0 can be viewed. However the data is still in the database
       //The messages are still in the database phpMyAdmin, so this is a creative way to delete messages apart from traditionally using a delete sql keyword
       //This is also backend execution of the function
		$database->query("UPDATE `wb_messages` SET `read_message`=1 WHERE `receiver`=".$user->id);


	</xmp>
</div>
<p>Result:</p>
<div class="well" style="background-color: #e6f7ff;">
	<?php

		global $database;
    	$sql = "SELECT * FROM wb_messages WHERE id=".$pm->id;
    	$group_member_array = $database->query($sql);
	    while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					echo "<strong>The read_message value is: </strong>";
					echo $set_array->read_message;
					echo "<br>";
				}
		}
		global $database;
		$result_set = $database->query("SELECT * FROM wb_messages WHERE read_message=0 AND id=".$pm->id);
	    $number_messages = $database->num_rows($result_set);


		echo "<strong>Number of messages visible on the icon before trigger: </strong>";
		echo $number_messages;
		echo "<br>";

		echo "<br>";
		$database->query("UPDATE `wb_messages` SET `read_message`=1 WHERE `id`=".$pm->id);
		echo "<strong>The icon is triggered</strong>";
		echo "<br>";
		echo "<br>";
		global $database;
    	$sql = "SELECT * FROM wb_messages WHERE id=".$pm->id;
    	$group_member_array = $database->query($sql);
	    while($log_array = $group_member_array->fetch_assoc())
		{
				if($log_array['id']==$pm->id)
				{
					$set_array=Message::find_by_id($log_array['id']);
					echo "<strong>The read_message value is: </strong>";
					echo $set_array->read_message;
					echo "<br>";
				}
		}

		global $database;
		$result_set = $database->query("SELECT * FROM wb_messages WHERE read_message=0 AND id=".$pm->id);
	    $number_messages = $database->num_rows($result_set);
		echo "<strong>Number of messages visible on the icon after trigger: </strong>";
		echo $number_messages;
		echo "<br>";
	?>
	</div>
	<p>Status:</p>
	<div class="well" style="background-color: #e6f7ff;">
	<?php
		$result_set = $database->query("SELECT * FROM wb_messages WHERE read_message=0 AND id=".$pm->id);
	    $number_messages = $database->num_rows($result_set);

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
						echo "<strong>Passed</strong>";
					}
					else
					{
						echo "<strong>Passed</strong>";
					}
				}
		}

	?>
	</div>

<?php
include('footer.html');
?>
