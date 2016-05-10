<?php
/**
 * When User clicks on Add Routine in the profile page, and adds fields for routine specifications
 *@pre: user session
 *@post: none
 *@return: routine object queried in database
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Set default time zone to central standard time
date_default_timezone_set("America/Chicago");

//Create User object for current session user
$user = User::find_by_id($session->user_id);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();

    //Trim all the incoming data:
    $trimmed = array_map('trim', $_POST);

    // Add routine to database:
    $rout = new Routine();
    $rout->user_id = $user->id;
    $rout->name = $database->escape_value($trimmed['routine_name']);
    $rout->description = $database->escape_value($trimmed['routine_description']);

    $monday=isset($_POST['mon']);
    if(empty($monday))
    {
        $rout->mon = 0;
    }
    else
    {
        $rout->mon = 1;
    }

    $tuesday=isset($_POST['tues']);
    if(empty($tuesday))
    {
        $rout->tues = 0;
    }
    else
    {
        $rout->tues = 1;
    }

    $wednesday=isset($_POST['wed']);
    if(empty($wednesday))
    {
        $rout->wed = 0;
    }
    else
    {
        $rout->wed = 1;
    }

    $thursday=isset($_POST['thurs']);
    if(empty($thursday))
    {
        $rout->thurs = 0;
    }
    else
    {
        $rout->thurs = 1;
    }

    $friday=isset($_POST['fri']);
    if(empty($friday))
    {
        $rout->fri = 0;
    }
    else
    {
        $rout->fri = 1;
    }

    $saturday=isset($_POST['sat']);
    if(empty($saturday))
    {
        $rout->sat = 0;
    }
    else
    {
        $rout->sat = 1;
    }

    $sunday=isset($_POST['sun']);
    if(empty($sunday))
    {
        $rout->sun = 0;
    }
    else
    {
        $rout->sun = 1;
    }

    $rout->start_date = $database->escape_value($trimmed['start_date']);
    $rout->end_date = $database->escape_value($trimmed['end_date']);

    $rout->create();
	$redirect_id = $database->insert_id();

    if ($database->affected_rows() == 1) {
        //Routine created
        //Add calendar events
		for ($i = strtotime($rout->start_date); $i <= strtotime($rout->end_date); $i = strtotime('+1 day', $i)) {

			if ($rout->mon==1 && date('N', $i) == 1){
				$event = new Event_Calendar();
				$event->user_id = $rout->user_id;
		      	$event->name = $rout->name;
				$event->description = $rout->description;
		      	$event->event_date= date('Y-m-d', $i);
		      	$event->create();
			}

			if ($rout->tues==1 && date('N', $i) == 2){
				$event = new Event_Calendar();
				$event->user_id = $rout->user_id;
				$event->name = $rout->name;
				$event->description = $rout->description;
				$event->event_date= date('Y-m-d', $i);
				$event->create();
			}

			if ($rout->wed==1 && date('N', $i) == 3){
				$event = new Event_Calendar();
				$event->user_id = $rout->user_id;
				$event->name = $rout->name;
				$event->description = $rout->description;
				$event->event_date= date('Y-m-d', $i);
				$event->create();
			}

			if ($rout->thurs==1 && date('N', $i) == 4){
				$event = new Event_Calendar();
				$event->user_id = $rout->user_id;
				$event->name = $rout->name;
				$event->description = $rout->description;
				$event->event_date= date('Y-m-d', $i);
				$event->create();
			}

			if ($rout->fri==1 && date('N', $i) == 5){
				$event = new Event_Calendar();
				$event->user_id = $rout->user_id;
				$event->name = $rout->name;
				$event->description = $rout->description;
				$event->event_date= date('Y-m-d', $i);
				$event->create();
			}

			if ($rout->sat==1 && date('N', $i) == 6){
				$event = new Event_Calendar();
				$event->user_id = $rout->user_id;
				$event->name = $rout->name;
				$event->description = $rout->description;
				$event->event_date= date('Y-m-d', $i);
				$event->create();
			}

			if ($rout->sun==1 && date('N', $i) == 7){
				$event = new Event_Calendar();
				$event->user_id = $rout->user_id;
				$event->name = $rout->name;
				$event->description = $rout->description;
				$event->event_date= date('Y-m-d', $i);
				$event->create();
			}
		}
        redirect_to("add_routine_exercise.php?id=".$redirect_id);
    }
    else { // If it did not run OK.
        echo 'Routine not created';
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

    <title>Workout Buddy - Add Routine</title>

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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

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
    <h2>Add Routine</h2>
       <form form action="add_routine.php" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="routine_name" class="form-control" id="exampleInputEmail1" placeholder="Routine Name" required autofocus>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="routine_description" class="form-control" rows="3" placeholder="Routine Description"></textarea>
      </div>
      <div class="panel panel-default">
      <div class="panel-body">
          <label>Select day(s) for routine</label>
          <div class="checkbox">
            <label>
                <input type="checkbox" name="sun" value="0">
                Sunday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="mon" value="0">
                Monday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="tues" value="0">
                Tuesday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="wed" value="0">
                Wednesday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="thurs" value="0">
                Thursday
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="fri" value="0">
                Friday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="sat" value="0">
                Saturday
            </label>
        </div>

        </div>
        </div>

        <div class="panel panel-default">
      <div class="panel-body">

        <div class="form-inline">
        <div class="form-group">
            <label for="exampleInputPassword1">Start Date</label>
                <div class="input-group">
                <input type="text" id="datepicker1" class="form-control" name="start_date">
                 <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
                </div>
        </div>
        &nbsp&nbsp
        <div class="form-group">
            <label for="exampleInputPassword1">End Date</label>
                <div class="input-group">
                <input type="text" id="datepicker2" class="form-control" name="end_date">
                 <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
                </div>
        </div>
        </div>
        </div>
        </div>

        <button type="submit" id="add_routine" class="btn btn-success">Add Routine</button>
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
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
  $(function() {
    $( "#datepicker1" ).datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        onSelect: function () {
            //select datepicker2 from the DOM
        	var datepicker2 = $('#datepicker2');

 			//Set min date to today	
            var minDate = $(this).datepicker('getDate');
                  
            //minDate of datepicker2 datepicker = dt1 selected day
            datepicker2.datepicker('setDate', minDate);
                  
           //first day which can be selected in datepicker2 is selected date in datepicker1
           datepicker2.datepicker('option', 'minDate', minDate);

           //same for datepicker1
           $(this).datepicker('option', 'minDate', minDate);
		}
    });
  });
  $(function() {
        $( "#datepicker2" ).datepicker({
              dateFormat: "yy-mm-dd"
        });
    });

  $('#add_routine').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

  });
  </script>
  </body>
</html>
