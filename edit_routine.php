<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Set default time zone to central standard time
date_default_timezone_set("America/Chicago");

//Create User object for current session user
$user = User::find_by_id($session->user_id);

//If the ID field is empty return the user to profile page
if (empty($_GET['rout_id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');
}

//Create Routine object from ID in the URL
$rout = Routine::find_by_id($_GET['rout_id']);
if(!$rout){
	$session->message("Unable to be find routine.");
	redirect_to('profile.php');
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $errors = array();
   
    $database->query("DELETE FROM wb_event_calendar WHERE user_id='{$user->id}' AND name='{$rout->name}'");
    
    //Trim all the incoming data:
    $trimmed = array_map('trim', $_POST);
   
    // Add routine to database:
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
   
    $rout->update();
               
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
        redirect_to("view_routine.php?id=".$rout->id);
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

    <title>Workout Buddy - Edit Routine</title>

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
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More Actions<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="add_group.php">Add Group</a></li>
                <li><a href="find_group.php">Find Group</a></li>
                <li><a href="find_user.php">Find User</a></li>
                <li><a href="message_menu.php">Messages</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
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
                    $result_set = $database->query("SELECT * FROM wb_messages WHERE 'read'!=0 AND receiver=".$user->id);
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
    <h2>Edit Routine</h2>
       <form form action="edit_routine.php?rout_id=<?php echo $_GET['rout_id']; ?>" method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="routine_name" class="form-control" id="exampleInputEmail1" placeholder="Routine Name" value="<?php echo $rout->name; ?>" required autofocus>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="routine_description" class="form-control" rows="3" placeholder="Routine Description"><?php echo $rout->description; ?></textarea>
      </div>
      <div class="panel panel-default">
      <div class="panel-body">
          <label>Select day(s) for routine</label>
          <div class="checkbox">
            <label>
                <input type="checkbox" name="sun" value="0" <?php if($rout->sun == 1) echo "checked"; ?>>
                Sunday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="mon" value="0" <?php if($rout->mon == 1) echo "checked"; ?>>
                Monday
            </label>
        </div>
        <div class="checkbox">
            <label>   
                <input type="checkbox" name="tues" value="0" <?php if($rout->tues == 1) echo "checked"; ?>>
                Tuesday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="wed" value="0" <?php if($rout->wed == 1) echo "checked"; ?>>
                Wednesday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="thurs" value="0" <?php if($rout->thurs == 1) echo "checked"; ?>>
                Thursday
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="fri" value="0" <?php if($rout->fri == 1) echo "checked"; ?>>
                Friday
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="sat" value="0" <?php if($rout->sat == 1) echo "checked"; ?>>
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
                <input type="text" id="datepicker1" class="form-control" name="start_date" value="<?php echo $rout->start_date; ?>">
                 <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
                </div>
        </div>
        &nbsp&nbsp
        <div class="form-group">
            <label for="exampleInputPassword1">End Date</label>
                <div class="input-group">
                <input type="text" id="datepicker2" class="form-control" name="end_date" value="<?php echo $rout->end_date; ?>">
                 <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
                </div>
        </div>
        </div>
        </div>
        </div>
       
        <button type="submit" id="add_routine" class="btn btn-default">Update Routine</button>
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
	          dateFormat: "yy-mm-dd"
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
