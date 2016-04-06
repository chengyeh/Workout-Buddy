<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  // Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

		// Add the group to the database:
		$group = new Group();
		$group->group_owner= $trimmed['user_id'];
      	$group->group_name= $trimmed['group_name'];
      	$group->group_status=$trimmed['group_status'];

      	$group->create();

      	//Redirect to profile page
      	redirect_to("view_group.php?id={$database->insert_id()}");
}
?>
<html>
<head>
	<title>Workout Buddy: Add Group</title>
</head>
	<body>
	<h1>Profile Page: Add Group</h1>
	<p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>

	<h2>User Info</h2>
	<?php
		echo "<p>User Name: " . $session->user_name. "</p>";
		echo "<p>User Id: " . $session->user_id . "</p>";
	?>

	<h2>Group Add Form</h2>
	<form action="#" method="post" enctype="multipart/form-data">
		 <input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
		<label>Group Name</label>
		<input type="text" name="group_name" required /><br/>
		<input type="radio" name="group_status" value="Private">Private<br>
		<input type="radio" name="group_status" value="Public">Public<br>
		<button type="submit" name="submit">Add group</button>
	</form>
	</body>
</html>
