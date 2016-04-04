<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
   echo "Inside php";
  $errors = array();

  // Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
				


		// Add the user to the database: 
		$group = new Group();
		$group->group_owner= $trimmed['user_id'];	
      	$group->group_name= $trimmed['group_name'];
     
      	$group->create();
}
?>
<html>
<head>
	<title>Workout Buddy: Add Group</title>
	
</head>
	<body>
	<h1>Profile Page: Add Group</h1>
	<p><a href="logout.php">logout</a></p>
	<?php 
	echo "<p>User Id: " . $session->user_id . "</p>";
	echo "<p>User Name: " . $session->user_name. "</p>";
	?>
	<form action="add_group.php" method="post" enctype="multipart/form-data">
		 <input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
		<label>Group Name</label>
		<input type="text" name="group_name" required /><br/>
		<button type="submit" name="submit">Add group</button>
	</form>
	</body>
</html>