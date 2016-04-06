<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

	if(!empty($_POST['delete_group']))
	{
		foreach($_POST['delete_group'] as $group_id)
		{
			$group = Group::find_by_id($group_id);
			$group->delete();
			$database->query("DELETE FROM wb_group_members WHERE group_id = '" . $group_id . "'");
		}
	}

}
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
	<form action="#" method="post">
	<?php
		$groups = $user->find_groups();
		if(!empty($groups)){
			echo "<table><tr><th>Name</th><th>Delete</th></tr>";
				foreach ($groups as $group){
					echo  "<tr><td><a href='view_group.php?id={$group->id}'>".$group->group_name."</a></td>";
					echo "<td style='text-align:center'><input type='checkbox' name='delete_group[]' value='" . $group->id . "'></td></tr>";
				}
			echo "<tr><td colspan='2' style='text-align:right'><button type='submit' name ='delete'>Delete</button></td></tr></table>";
		}else{
			echo  "No groups<br/>";
		}
	?>
	</form>
	<p><a href="add_group.php">Add Group</a></p>
  <p><a href="addChallenges.php">Add Challenge</a><p>
	</body>
</html>
