<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');
}

//Create User object
$user = User::find_by_id($_GET['id']);
if(!$user){
	$session->message("Unable to be find group.");
	redirect_to('profile.php');
}
?>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>Profile Page</h1>
		<p><a href="logout.php">logout</a></p>
		<h2>User Info</h2>
		<?php 
			echo "<p>User Name: ". $user->full_name() . "<br/>";
			echo "<p>User Id: " . $user->id . "</p>";
		?>
		
		<h2>User Groups</h2>
		<?php 
			$groups = $user->find_groups();
			if(!empty($groups)){
				echo "<table><tr><th>Name</th></tr>";
					foreach ($groups as $group){
						echo  "<tr><td><a href='view_group.php?id={$group->id}'>".$group->group_name."</a></td></tr>";
					}
				echo "</table>";
			}else{
				echo  "No groups<br/>";
			}
		?>
	</body>
</html>