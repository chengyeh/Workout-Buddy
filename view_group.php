<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');
}

$group = Group::find_by_id($_GET['id']);
if(!$group){
	$session->message("Unable to be find group.");
	redirect_to('profile.php');
}

?>
<html>
<head>
	
</head>
	<body>
	<h1>View Group Page</h1>
	<p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>
	<h2>User Info</h2>
	<?php 
		echo "<p>User Name: ". $user->full_name() . "<br/>";
		echo "<p>User Id: " . $session->user_id . "</p>";
	?>
	
	<h2>User Group Info</h2>
	<?php 
		echo "<p>Grop Name: ". $group->group_name . "<br/>";
	?>
	
	<h2>User Group Members</h2>

	<?php 
		$group_members = $group->get_members();
		if(($group_members->num_rows) > 0)
		{
			echo "<table><tr><th>Name</th></tr>";
			while($row = $group_members->fetch_assoc())
			{
				$user = User::find_by_id($row["member_id"]);
				echo "<tr><td>" . $user->full_name() . "</td></tr>";	
	
			}
			echo "</table>";			
		}
	?>

	
	
	<p><a href="add_group_members.php?id=<?php echo $group->id; ?>">Add Members</a></p>
	</body>
</html>