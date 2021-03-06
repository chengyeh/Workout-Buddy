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
 * Finds the group matching a users search request. The user can search in terms of what exercise the group focuses on.
 * A successful query returns an array contain all the results of the query. The groups in the array are displayed in a table.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

// Create User object for the current session user.
$user = User::find_by_id($session->user_id);

// Get all the group activity to populate the 
// select box in form
$group_activity = Group::get_activity();

?>

<?php
$search_string;
// If submit button is clicked, check if the search field is empty or has invalid value 
if(isset($_GET['submit'])){
  $search = array();
  $activity = $database->escape_value($_GET['group_activity']);
  
  // If it's ok put user input into search_string, else display error message
  if(isset($activity)&& (!empty($activity)|| $activity !=0)){
    $search_string = " group_activity LIKE '%{$activity}%' ";
  }elseif (!isset($activity) || (empty($activity) || $activity==0)){
    $message = "Check your search name.";
  }
}

// If serach_string is valid and no error message, query the result from wb_group table
if(isset($search_string) && empty($message)){
	//Assemble sql statement
	$sql = "SELECT * FROM wb_group ";
	$sql .= "WHERE {$search_string} AND  group_status='Public' ";
	$sql .= "ORDER BY group_name ASC ";
	
    $groups = Group::find_by_sql($sql);
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

    <title>Workout Buddy - Find Group</title>

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
  	<!-- Two coloum layout -->
  	<!-- First coloum: Search box -->
  	<div class="col-md-3">
  	<h2>Search</h2>
  	<form action="find_group.php" method="get">
  		<fieldset class="form-group">
		   <label for="formGroupExampleInput">Search by Activity</label>
		   <select name="group_activity" class="form-control" required>
		   <?php 
		   		echo "<option value=''></option>";
		   		foreach ($group_activity as $key => $value){
					echo "<option value='{$value}'>{$value}</option>";
				}		   
		   ?>	  
			</select>
		</fieldset>
		<button type="submit" name="submit" class="btn btn-default">Search</button>
  	</form>
  	</div>
  	
  	<!-- Second coloum: Search results -->
  	<div class="col-md-9">
  	
  	<?php 
  		// If there is a result, for each group display their name, description, and join button
  		if(isset($groups)){
			echo "<h2>Search Results for {$activity}</h2>";
	  		if(!empty($groups)){
				echo "<table class='table'>";
		  		echo "<tr><th>Name</th><th>Discription</th><th></th></tr>";
		  		foreach ($groups as $group){
		  			$group_member_id_array = $group->get_member_id_array();
					$ifJoin = false;
					for($i = 0; $i < count($group_member_id_array); $i++)
					{
						if($session->user_id == $group_member_id_array[$i]['member_id'])
						{
							$ifJoin = true;
						}
					}
					echo "<tr><td><a href='view_group.php?id={$group->id}'>{$group->group_name}</a></td>";
					
					// If user already joined the group it will show the "Joined" button, else the user can click "Join" button to join the group
					if($ifJoin == false)
					{
						echo "<td>{$group->group_discription}</td><td class='text-center'><a class='btn btn-sm btn-success' href='add_public_group_member.php?user_id={$session->user_id}&group_id={$group->id}' role='button'>Join</a></td></tr>";
					}
					else {
						echo "<td>{$group->group_discription}</td><td class='text-center'><a class='btn btn-sm btn-warning' href='view_group.php?id={$group->id}' role='button'>Joined</a></td></tr>";
					}					
				}
				echo "</table>";
			}else{
				echo "<h3>No groups found.</h3>";
			}
		}
  	?>
  	</div>
  	
  	
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
