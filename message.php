<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);



require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);

?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

	if(!empty($_POST['user_id_array']))
    {
        foreach($_POST['user_id_array'] as $user_id)
        {
            // Add the group member to the database:
            $mess5 = new Message();
            $mess5->user = $user->id;
            $mess5->reciever = $user_id;
         	 $mess5->message = $_POST['message'];
            $mess5->create();
        }
     }
     else if(empty($_POST['user_id_array']))
     {
     	redirect_to("message_menu.php");
     }

}
?>

<html>
<head>
	<title> Send a Message </title>

</head>
	<body>
	<?php
		$users = User::find_all();
		if(!empty($users)){
			echo "<form action='#' method='post'><table>";
			foreach ($users as $user)
			{
				echo "<tr><td><input type='checkbox' name='user_id_array[]' value='{$user->id}'></td>";
  				echo "<td>".  $user->full_name() ."</td></tr>";
			}
			echo "</table>";

			echo "<input type='text' name='message'>";

			echo "<input type='submit' value='Send Message' name='submit'></form>";

		}
		else
		{

		}

	?>
	</body>
</html>
