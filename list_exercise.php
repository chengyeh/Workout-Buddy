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
/*
 *	@file list_exercise.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Display all the types of excersices in the database.
*			  Note: This is a test page used to list all the exercises in the datbase
*				    not used in web app functionality.
*/
error_reporting(E_ALL);
ini_set("display_errors", 1);

$number_messages=0;

// Include initialization file
require_once('includes/initialize.php');

//If user is not logon redirect to login page
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);

//get the current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

//recodrs per page
$per_page = 10;

//Get the count of excerices from database
$sql = "SELECT COUNT(*) FROM wb_exercise_type";
$result_set = $database->query($sql);
$row = $database->fetch_array($result_set);

//Get the row count
$total_count = array_shift($row);

//Initialize pagination
$pagination = new Pagination($page, $per_page, $total_count);

//Build the sql query for pagination
$sql = "SELECT * FROM wb_exercise_type ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

//Query the exercises		
$exercises = $database->query($sql);

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

    <title>Fixed Top Navbar Example for Bootstrap</title>

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
  	
  	<h2>List Exercise</h2>
 <div>
  	<?php 
  	//Display the results
	while ($row = mysqli_fetch_array($exercises)) 
	{
	    echo $row['name']. "<br/>";
	}
	?>
 </div>
 
 <div>
 
 <?php
 //Dispaly the pagination bar
 if($pagination->total_pages() > 1) {
 
 	if($pagination->has_previous_page()) {
 		echo "<a href=\"list_exercise.php?page=";
 		echo $pagination->previous_page();
 		echo "\">&laquo; Previous</a> ";
 	}
 
 	for($i=1; $i <= $pagination->total_pages(); $i++) {
 		if($i == $page) {
 			echo " <span class=\"selected\">{$i}</span> ";
 		} else {
 		echo " <a href=\"list_exercise.php?page={$i}\">{$i}</a> ";
 		}
 	}
 
 	if($pagination->has_next_page()) {
 	echo " <a href=\"list_exercise.php?page=";
			echo $pagination->next_page();
 			echo "\">Next &raquo;</a> ";
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
