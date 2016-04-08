
<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $errors = array();

    if(!empty($_POST['delete_message']))
    {

        foreach($_POST['delete_message'] as $message_id)
        {
        	$value=1;
            $database->query("UPDATE message_test SET del_receive = 1 WHERE id = ".$message_id);
        }
    }
}
?>

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
	<th>Time</th>
	<th>Date</th>
	<th>Delete</th>


	<?php
			  	error_reporting(E_ALL);
			ini_set("display_errors", 1);

			require_once('includes/initialize.php');
			if(!$session->is_logged_in()){ redirect_to("login.php"); }

			//Create User object
			$user = User::find_by_id($session->user_id);

			$message_array=$user->receive_messages();
			$a=1;

			echo "<form action='#' method='POST'>";
			echo "<tr>";
			while($message1 = $message_array->fetch_assoc())
			{


				$t=User::find_by_id($message1['user']);
				echo $message1['id'];
				echo "<td>";
				echo $a."<td>";
				$a=$a+1;
				echo $t->full_name()."<td>";
				echo $message1['message'];
				echo "<td>".$message1['Time'];
				echo "<td>".$message1['Date'];
				echo "<td>"."<input type='checkbox' name='delete_message[]' value='".$message1["id"]."'>";
				echo "<tr>";


			
			}
			echo "</table>";
			echo "<input type='submit' name ='submit' value='Submit'>";
			echo "</form>";
			if($a==1)
			{
				echo "<tr>"."<td>"."No Messages";

			}

  ?>



</body>
</html>
