<?php
// Workout Buddy Manual
// 
//    
// Copyright (C) <2016>  <Paul Charles, Kuei-Hsien Chu, Purna Doddapaneni, Dilesh Fernando, Cheng-Yeh Lee>
// 
// This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
// 
// You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
?>
<?php
 /**
 * This class serves as the central starting point for the user to access all other classes for various functionality.
 * Based on the user choice, the page redirects the user to different classes.
 *
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

$number_messages=0;

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

// Create User object for the current session user.
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

	if(!empty($_POST['delete_routine']))
	{
		foreach($_POST['delete_routine'] as $routine_id)
		{
			$routine = Routine::find_by_id($routine_id);

			$database->query("DELETE FROM wb_exercise WHERE routine_id = '" . $routine_id . "'");
			$database->query("DELETE FROM wb_exercise_set WHERE routine_id = '" . $routine_id . "'");
            $database->query("DELETE FROM wb_event_calendar WHERE user_id = '" . $user->id . "' AND name = '". $routine->name . "'");
            $database->query("DELETE FROM wb_log_category WHERE routine_id = '" . $routine_id . "'");
                        $database->query("DELETE FROM wb_user_log WHERE routine_id = '" . $routine_id . "'");
            $routine->delete();
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
    <meta name="author" content="" >
    <link rel="icon" href="../../favicon.ico">

    <title>Home - <?php echo $user->full_name()?></title>

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
            <li><a href="about_page.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More Actions<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="add_group.php">Add Group</a></li>
                <li><a href="find_group.php">Find Group</a></li>
                <li><a href="find_user.php">Find User</a></li>
                <li><a href="message_menu.php">Messages</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Progress</li>
                <li><a href="view_log.php">View Log</a></li>
                <li><a href="addChallenges.php">Add Challenge</a></li>
                <li><a href="view_challenges.php">View Challenge</a></li>
              </ul>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right" id="navbar-status">
            <li><span class="glyphicon glyphicon-calendar"><a href="show_calendar">Calendar</a></span>&nbsp&nbsp</li>
            <li>
            	<span>
	            <?php
	            	// Query unread messages from the wb_messages table and display the count.
	            	$result_set = $database->query("SELECT * FROM wb_messages WHERE read_message=0 AND receiver=".$user->id);
	            	$number_messages = $database->num_rows($result_set);
	            	echo "<span class='badge'>{$number_messages}</span>";
	            ?>
	            <a href="inbox.php">Inbox</a>
	            </span>&nbsp&nbsp
            </li>

            <li><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Hi <?php echo $session->user_name; ?>&nbsp&nbsp</li>
            <li><span><a class="btn btn-primary btn-sm" href="logout.php" role="button">Logout</a></span>&nbsp&nbsp</li>
         </ul>

        </div><!--/.nav-collapse -->
      </div>

    </nav>

    <div class="container">

    <!-- Main component for a primary marketing message or call to action -->
	<h1>Profile Page</h1>

	<h2>User Info</h2>
	<?php
		echo "<p>" . $user->full_name() . "</p>";
	?>

	<h2>Groups Added</h2>
	<p><a class="btn btn-default" href="add_group.php" role="button">Add Group</a></p>
	<form action="#" method="post">
	<?php
		$groups_owned = $user->find_groups();
		$groups_joined = $user->groups_joined();
		$exercises_added=$user->exercise_routines_added();

		// If user owns at least one group, display its name, status, and button to delete it
		if(!empty($groups_owned)){
			echo "<table class='table'><tr><th>Name</th><th>Status</th><th class='text-center'>Delete</th></tr>";
				//List all the groups this user owns
				foreach ($groups_owned as $group){
					echo "<tr><td><a href='view_group.php?id={$group->id}'>".$group->group_name."</a></td>";
					echo "<td>{$group->group_status}</td>";
					echo "<td style='text-align:center'><input type='checkbox' name='delete_group[]' value='" . $group->id . "'></td></tr>";
				}
			echo "<tr><td></td><td></td><td class='text-center'><button type='submit' class='btn btn-default' name ='delete'>Delete</button></td></tr></table>";
		}else{
			echo  "No groups<br/>";
		}
	?>
	</form>

	<h2>Groups Joined</h2>
	<p><a class="btn btn-default" href="find_group.php" role="button">Find Group</a></p>
	<?php
		// If user has joined at least one group, display its name, and status
		if(!empty($groups_joined))
		{
			echo "<table class='table'><tr><th>Name</th><th></th><th class='text-center'>Status</th></tr>";
			foreach ($groups_joined as $group_member_row){
				$same_group = false;
				// Check if the joined group is owned by this user
				for($i = 0; $i < count($groups_owned); $i++)
				{
					if($group_member_row->group_id == $groups_owned[$i]->id)
					{
						$same_group = true;
					}
				}
				// List all the groups this user joined but doesn't own
				if($same_group == false)
				{
					$group_joined = Group::find_by_id($group_member_row->group_id);
					echo "<tr><td><a href='view_group.php?id={$group_joined->id}'>".$group_joined->group_name."</a></td>";
					echo "<td></td><td class='text-center'>{$group_joined->group_status}</td></tr>";
				}
			}
			echo "</table>";
		}else{
			echo  "No groups<br/>";
		}
	?>

  <br>
	<h2>Exercise Routines</h2>
	<p><a class="btn btn-default" href="add_routine.php" role="button">Add Routine</a></p>
	<form action="#" method="post">
	<?php
		$user_routine_objects = $user->exercise_routines_added();

		// If user created at least one routine, display its name, and button to delete it
		if(!empty($user_routine_objects))
		{
			echo "<table class='table'><tr><th>Name</th><th></th><th class='text-center'>Delete</th></tr>";

			foreach ($user_routine_objects as $routine_object)
			{
				echo "<tr><td><a href='view_routine.php?id={$routine_object->id}'>".$routine_object->name."</a></td>";
				echo "<td></td><td style='text-align:center'><input type='checkbox' name='delete_routine[]' value='" . $routine_object->id . "'></td></tr>";
			}
			echo "<tr><td></td><td></td><td class='text-center'><button type='submit' class='btn btn-default' name ='delete'>Delete</button></td></tr></table>";
		}else{
			echo  "<p>No Routines</p>";
		}
	?>
	</form>

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
