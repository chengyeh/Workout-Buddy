<?php
/**
 * When User clicks on a group, all members of the group and the groups activity are queried from he database and printed in a table. If the user id matches that of the owner of the group, adminstrative priveleges are granted and the owner can delete members.
 * 
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');
}

//Create Group object from ID in the URL 
$group = Group::find_by_id($_GET['id']);
if(!$group){
	$session->message("Unable to be find group.");
	redirect_to('profile.php');
}

//Create User object for group owner
$group_owner = User::find_by_id($group->group_owner); 	
?>
<?php
/**
 * Query the database and obtain an array containin all members of the group. 
 * 

 */
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

    if(!empty($_POST['delete_group_member']))
    {
        foreach($_POST['delete_group_member'] as $member_id)
        {
            $database->query("DELETE FROM wb_group_members WHERE group_id = '" . $group->id . "' AND member_id='" . $member_id . "'");  
        } 
    }               
}
?>
<html>
    <head>
		<title><?php echo $group->group_name ?></title>
    </head>
	<body>
    	<h1>View Group Page</h1>
    	<p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>
    	
    	<h2>Group Info</h2>
    	<?php 
    	/**
        * Print out all the details of the group based on the group define by the $group variable. 
        * 
        *
        */
    		echo "<p>Group Name: ". $group->group_name . "<br/>";
			echo "<p>Group Id: " . $group->id . "</p>";
			echo "<p>Owner: ". $group_owner->full_name() . "<br/>";
			echo "<p>Owner Id: " . $group_owner->id . "</p>";
    	?>
    	
    	<h2>Group Members</h2>
    	<?php 
		/**
                * Get all members of the group utilizin the get_members function from groupp. Restrict permissions to delete or add to owner only and display all users in a table along with the option to delete them if desired. If there are no members in the group, print no members.
                */
		$group_members = $group->get_members();
			//Restrict only the group owner can edit the group members
			if($user->id == $group->group_owner)
			{
				if(($group_members->num_rows) > 0)
				{
					echo "<form action='#' method='post'>";
					echo "<table><tr><th>Name</th><th>Kick</th></tr>";
					//Display all the members from this group and checkbox to delete them
        			while($row = $group_members->fetch_assoc())
        			{
        				$user = User::find_by_id($row["member_id"]);
        				echo "<tr><td><a href='view_profile.php?id={$row["member_id"]}'>" . $user->full_name() . "</a></td>";
						if($row["member_id"] != $session->user_id)
						{
							echo "<td style='text-align:center'><input type='checkbox' name='delete_group_member[]' value='" . $row["member_id"] . "'></td></tr>";
						}
						else
						{
							echo "<td style='text-align:center'>Owner</td></tr>";
						}	
        			}	
                    echo "<tr><td colspan='2' style='text-align:right'><button type='submit' name ='kick'>Kick</button></td></tr></table></form>";	
				}
				else 
				{
						echo "No members<br/>";
				}
				echo "<p><a href='add_group_members.php?id={$group->id}'>Add Members</a></p>";
			}
			else
			{
				if(($group_members->num_rows) > 0)
				{
					//Basic info of the group
					echo "<table><tr><th>Name</th></tr>";
        			while($row = $group_members->fetch_assoc())
        			{
        				$user = User::find_by_id($row["member_id"]);
        				echo "<tr><td><a href='view_profile.php?id={$row["member_id"]}'>" . $user->full_name() . "</a></td></tr>";
        			}	
                    echo "</table>";
				}
				else
				{
					echo "No members<br/>";
				}
			}
    	?>
	</body>
</html>