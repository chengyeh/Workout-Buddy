<?php
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }
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
	<form>
		 <input type="hidden" name="user_id" value='<?php echo user_id; ?>'>
		<label>Group Name</label>
		<input type="text" name="group_name" required /><br/>
		<label>Group Discription</label>
		<input type="text" name="group_discription" required /><br/>
		<label>Group Location</label>
		<input type="text" name="group_location" required /><br/>
		<label>Group Type</label>
		 <select>
			<option value="running">Running</option>
			<option value="swimming">Swmming</option>
			<option value="weight training">Weight Training</option>
			<option value="yoga">Yoga</option>
		</select><br/>
		<button type="submit" name="submit">Add group</button>
	</form>
	</body>
</html>