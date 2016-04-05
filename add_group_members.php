<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

if (isset($_POST['add_members'])){
	$userIdArray = $_POST['user_id_array'];

    if(empty($userIdArray)) 
    {
     	echo("You did not select any posts.");
    } 
    else{
    	//Get number of elements
    	$userCount = count($postIdArray);
   		
   		//Create mysql object with credentials
   		$mysqli = new mysqli("mysql.eecs.ku.edu", "dfernand", "1045155", "dfernand");
   		
   		//Check connection
   		if ($mysqli->connect_errno) {
   			printf("Connect failed: %s\n", $mysqli->connect_error);
   			exit();
   		}
   		
   		//Delete each post
   		for($i=0; $i < $postCount; $i++){
   			//Form the query string
   			$sql = "DELETE FROM Posts WHERE post_id = {$postIdArray[$i]}";
   			 
   			//Query database
   			if ($mysqli->query($sql) === TRUE) {
   				//record got deleted
   			}
   			else {
   				//print mysql error
   				echo "Error: " . $query . "<br>" . $mysqli->error;
   			}
   		}
   		
   		//Close connection
   		$mysqli->close();
 	}
}

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
	<h1>Add Members to Group</h1>
	<p><a href="profile.php">Profile</a>|<a href="view_group.php?id=1">Profile</a>|<a href="logout.php">logout</a></p>
	<h2>User Info</h2>
	<?php 
		echo "<p>User Name: ". $user->full_name() . "<br/>";
		echo "<p>User Id: " . $session->user_id . "</p>";
	?>
	
	<h2>User Group Info</h2>
	<?php 
		echo "<p>Grop Name: ". $group->group_name . "<br/>";
		echo "<p>Grop Id: ". $group->id . "<br/>";
	?>
	
	<h2>User Group Add Members</h2>
	<?php 
		$users = User::find_all();
		if(!empty($users)){
			echo "<form action='#' method='post'><table>";
			foreach ($users as $user){
				echo "<tr><td><input type='checkbox' name='user_id_array[]' value='{user->id}'></td>";
  						echo "<td>".  $user->full_name() ."</td></tr>"; 
			}
			echo "</table>";
			
			echo "<input type='submit' value='Add Members' name='add_members'></form>";
		}else{
			echo  "No users<br/>";
		}	
	?>
	</body>
</html>