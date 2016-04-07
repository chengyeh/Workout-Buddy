


<html>
<head>
<title>User Information</title>

</head>
<body>
 	<table border = "1">
	<tr>
	<th>No.</th>
	<th>From</th>
	<th>Message</th>
	<tr>

	<?php
			  	error_reporting(E_ALL);
			ini_set("display_errors", 1);

			require_once('includes/initialize.php');
			if(!$session->is_logged_in()){ redirect_to("login.php"); }

			//Create User object
			$user = User::find_by_id($session->user_id);

			$message_array=$user->receive_messages();
			$a=1;

			while($message1 = $message_array->fetch_assoc())
			{
				echo "<tr>";
				$t=User::find_by_id($message1['user']);
				echo "<td>";
				echo $a."<td>";
				$a=$a+1;
				echo $t->full_name()."<td>";
				echo $message1['message'];
				echo "<tr>";
			}
			if($a==1)
			{
				echo "<tr>"."No Messages"."<tr>";

			}

  ?>

	</table>
</body>
</html>
