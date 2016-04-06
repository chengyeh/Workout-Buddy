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

$group_owner = User::find_by_id($group->group_owner); 	
?>
<?php
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
	
    </head>
	<body>
    	<h1>View Group Page</h1>
    	<p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>
    	
    	<h2>User Group Info</h2>
    	<?php 
    		echo "<p>Group Name: ". $group->group_name . "<br/>";
			echo "<p>Group Id: " . $group->id . "</p>";
			echo "<p>Owner: ". $group_owner->full_name() . "<br/>";
			echo "<p>Owner Id: " . $group_owner->id . "</p>";
    	?>
    	
    	<h2>User Group Members</h2>
    	<?php 
    		$group_members = $group->get_members();
    		if(($group_members->num_rows) > 0)
    		{
    			if($user->id == $group->group_owner)
				{
					echo "<form action='#' method='post'>";
					echo "<table><tr><th>Name</th><th>Kick</th></tr>";
        			while($row = $group_members->fetch_assoc())
        			{
        				$user = User::find_by_id($row["member_id"]);
        				echo "<tr><td><a href='view_profile.php?id={$row["member_id"]}'>" . $user->full_name() . "</a></td>";	
                        echo "<td style='text-align:center'><input type='checkbox' name='delete_group_member[]' value='" . $row["member_id"] . "'></td></tr>";
        			}	
                    echo "<tr><td colspan='2' style='text-align:right'><button type='submit' name ='kick'>Kick</button></td></tr></table></form>";
					echo "<p><a href='add_group_members.php?id={$group->id}'>Add Members</a></p>";
				}
				else{
					echo "<table><tr><th>Name</th></tr>";
        			while($row = $group_members->fetch_assoc())
        			{
        				$user = User::find_by_id($row["member_id"]);
        				echo "<tr><td><a href='view_profile.php?id={$row["member_id"]}'>" . $user->full_name() . "</a></td></tr>";
        			}	
                    echo "</table>";	
				}

    		}
    	?>
	</body>
</html>