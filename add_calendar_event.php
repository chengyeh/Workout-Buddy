<?php
/*
 *	@file add_calendar_event.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Add user calender event to the databse. 
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

//user unread messages
$number_messages=0;

// Include initialization file
require_once('includes/initialize.php');

//If user is not logon redirect to login page
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  // Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

		// Add the group to the database:
		$event = new Event_Calendar();
		$event->user_id = $database->escape_value($trimmed['user_id']);
      	$event->name = $database->escape_value($trimmed['event_name']);
		$event->description = $database->escape_value($trimmed['event_name']);
      	$event->event_date= $database->escape_value($trimmed['event_date'])." ". $database->escape_value($trimmed['event_time']);
      	
      	//Save the event to the database
      	$event->create();

      	//Redirect to profile page
      	redirect_to("show_calendar.php");
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
    <link href="dist/css/calendar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  	<link href="dist/css/calendar.css" rel="stylesheet" type="text/css" media="all">
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	<link rel="stylesheet" type="text/css" href="dist/css/jquery.timepicker.css">
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
	<div class="col-xs-12 col-sm-6 col-md-8">
	<h2>Add Event</h2>
	<form action="#" method="post" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
	
		<fieldset class="form-group">
		   <label for="formGroupExampleInput">Event Name</label>
		   <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Event Name" name="event_name" required autofocus>
		</fieldset>
  		<fieldset class="form-group">
		   <label for="formGroupExampleInput">Event Discription</label>
		   <textarea name="event_discription" class="form-control" id="formGroupExampleInput" placeholder="Event Description"rows="4" cols="50" required></textarea>
		</fieldset>
		<div class="panel panel-default">
  		<div class="panel-body">
		<fieldset class="form-group">
		    <div class="form-inline">
			<div class="form-group">
			    <label for="exampleInputPassword1">Event Date</label>
			    	<div class="input-group">
			    	<input type="text" id="datepicker" class="form-control" name="event_date">
			    	 <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
			    	</div>
			</div>
			&nbsp&nbsp
			<div class="form-group">
			    <label for="exampleInputPassword1">Event Time</label>
			    	<div class="input-group col-sm-6">
			    		<input class="hasDatepicker form-control" name="event_time" id="datetimepicker" data-time-format="H:i:s" type="text">
			    	 <div class="input-group-addon"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></div>
			    	</div>
			</div>
			</div>
		</fieldset>
		</div>
		</div>
		<button type="submit" name="submit" class="btn btn-default">Add Event</button>
	</form>
	
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
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="js/jquery.timepicker.js"></script>
    <script>
    	  //JQuery to display datepicker UI
		  $(function() {
		    $( "#datepicker" ).datepicker({
		    	  dateFormat: "yy-mm-dd"
		    });
		  });

		//JQuery to display timepicker UI
		  $(function() {
			  $('#datetimepicker').timepicker();
		  });
	</script>
	</body>
</html>