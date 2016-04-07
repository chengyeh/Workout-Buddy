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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $group->group_name; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--  <a class="navbar-brand" href="#">Project name</a> -->
          <img id="navbar-logo-image" alt="workout buddy logo" src="images/Workout_Buddy_Logo_small.png">
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="profile.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More Actions<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="add_group.php">Add Group</a></li>
                <li><a href="find_group.php">Find Group</a></li>
                <li><a href="find_user.php">Find User</a></li>
                <li><a href="message.php">Messages</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="addChallenges.php">Add Challenge</a></li>
                <li><a href="view_challenges.php">View Challenge</a></li>
              </ul>
            </li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right" id="navbar-status">
            <li><span ><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp Hi <?php echo $session->user_name; ?>!&nbsp &nbsp<a class="btn btn-primary btn-sm" href="logout.php" role="button">Logout</a></span>
        </div><!--/.nav-collapse -->
      </div>
      
    </nav>

    <div class="container">
    	
    	<h2>Group Info</h2>
    	<?php 
    	/**
        * Print out all the details of the group based on the group define by the $group variable. 
        * 
        *
        */
    		echo "<p>Group Name: ". $group->group_name . "<br/>";
			echo "<p>Group Activity: ". $group->group_activity . "<br/>";
			echo "<p>Owner: ". $group_owner->full_name() . "<br/>";
    	?>
    	
    	<h2>Group Members</h2>
    	<!-- <p><a class="btn btn-default" href="add_group_members.php?id=<?php echo $group->id; ?>" role="button">Add Members</a></p> -->
    	<?php 
		/**
                * Get all members of the group utilizin the get_members function from groupp. Restrict permissions to delete or add to owner only and display all users in a table along with the option to delete them if desired. If there are no members in the group, print no members.
                */
		$group_members = $group->get_members();
			//Restrict only the group owner can add or delete the group members
			if($user->id == $group->group_owner)
			{
				echo "<p><a class='btn btn-default' href='add_group_members.php?id={$group->id}' role='button'>Add Members</a></p>";
				if(($group_members->num_rows) > 0)
				{
					echo "<form action='#' method='post'>";
					echo "<table class='table'><tr><th>Name</th><th class='text-center'>Remove</th></tr>";
					//Display all the members from this group and check box to delete them
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
                    echo "<tr><td></td><td class='text-center'><button type='submit' class='btn btn-default' name ='remove'>Remove</button></td></tr></table></form>";	
				}
				else 
				{
						echo "No members<br/>";
				}
				
			}
			else
			{
				if(($group_members->num_rows) > 0)
				{
					//Basic info of the group
					echo "<table class='table'><tr><th>Name</th></tr>";
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
	
   </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>