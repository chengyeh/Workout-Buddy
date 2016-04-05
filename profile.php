<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);
?>
<html>
<head>
	
</head>
	<body>
	<h1>Profile Page</h1>
	<p><a href="logout.php">logout</a></p>
	<h2>User Info</h2>
	<?php 
		echo "<p>User Name: ". $user->full_name() . "<br/>";
		echo "<p>User Id: " . $session->user_id . "</p>";
	?>
	
	<h2>User Groups</h2>
	<?php 
		$groups = $user->find_groups();
		foreach ($groups as $group){
			echo  $group->group_name . "<br/>";
		}	
	?>
	<p><a href="add_group.php">Add Group</a></p>
	</body>
</html>