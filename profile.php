<?php
ob_start();
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

?>
<html>
<head>
	
</head>
	<body>
	<h1>Profile Page</h1>
	<p><a href="logout.php">logout</a></p>
	<?php 
	echo "<p>User Id: " . $session->user_id . "</p>";
	echo "<p>User Name: " . $session->user_name. "</p>";
	?>
	<p><a href="add_group.php">Add Group</a></p>
	</body>
</html>