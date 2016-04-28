<?php

//=========== SET TIMEZONE =======================
date_default_timezone_set('America/Denver');
/**
 * When User clicks on a routine, all exercise of the routine and the sets are queried from he database and printed in a table.
 *
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);

//If the id field is empty return the user to profile page


//Create Routine object from id in the URL


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

    <title><?php echo $rout_show->name; ?></title>

    <link href="css/routine_table.css" rel="stylesheet" type="text/css" media="screen" />

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

        <h2>Log History</h2>
       	<?php
       		//echo $user->id;
       		$a=1;
       		$log_array=$user->display_log();
       		echo "<table class='table'><tr><th>Exercise</th><th>Routine</th><th>Date</th><th>Time</th>";
			while($log_disp = $log_array->fetch_assoc())
			{
				$log_name=Log::find_by_id($log_disp['id']);
				$routine_log=Routine::find_by_id($log_disp['routine_id']);
				$exercise_log=Exercises::find_by_id($log_disp['exercise_id']);
				$type_log=Types::find_by_id($exercise_log->type);
				echo "<tr>";

				$a=$a+1;

				//echo "<td>" . $type_log->name."</td>";
				echo "<td><a href='view_exercise_log.php?id={$log_disp['id']}'>".$type_log->name."</a></td>";
				echo "<td>" . $routine_log->name."</td>";
				echo "<td>" . $log_disp['Date'] . "</td>";
				echo "<td>" . $log_disp['Time'] . "</td>";

				echo "</tr>";
			}
			echo "</table>";
       	?>


      <!---Hsien's mess----------------------------------------------------------------------------------------------------------------------------->
      <?php
      global $database;

      $user = $user->id;

      //pull out all the diffrent workouts from the user
      $sql_1 = "SELECT DISTINCT exercise_type_id FROM `wb_user_log` WHERE user_id LIKE '". $user . "';";
      $array_exercise;

      $result_1 = $database->query($sql_1);

      echo "<table class='table'><tr><th> You have done the following:   </th><th>Your Max:</th><th>Your worst:</th><th>Your strengh is growing at:   </th><th>Between:    </th></tr>";
      while($row_1 = $result_1->fetch_assoc()){

        echo "<tr>";
        // this will get different workout that the user have; type Int
        $exercise_id = $row_1["exercise_type_id"];

        //pull out the workout names
        $sql_2 = "SELECT name FROM `wb_exercise_type` WHERE id = '". $exercise_id. "';";
        $result_2 = $database->query($sql_2);
        $row_2 = $result_2->fetch_assoc();
        echo "<td>".  $row_2["name"] ."</td>";

        //pull out the minimum weight (weakest workout) record
        $sql_3 = "SELECT MIN(weight), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
        $sql_31 = "SELECT MIN(date), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
        $result_3 = $database->query($sql_3);
        $result_31 = $database->query($sql_31);
        $row_3 = $result_3->fetch_assoc();
        $row_31 = $result_31->fetch_assoc();
        $min_weight = $row_3["MIN(weight)"];


        $d1 = $row_31["MIN(date)"];
        $d1 = str_replace('-', '/', $d1); // change format
        $d1 = strtotime($d1);


        //pull out the maximum weight (weakest workout) record
        $sql_4 = "SELECT MAX(weight), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
        $sql_41 = "SELECT MAX(date), date FROM `wb_user_log` WHERE (exercise_type_id = '". $exercise_id . "' ) AND (user_id = '". $user ."');";
        $result_4 = $database->query($sql_4);
        $result_41 = $database->query($sql_41);
        $row_4 = $result_4->fetch_assoc();
        $row_41 = $result_41->fetch_assoc();
        $max_weight = $row_4["MAX(weight)"];
        echo "<td>".$max_weight." lb </td><td>".$min_weight." lb</td>";


        $d2 = $row_41["MAX(date)"];
        $d2 = str_replace('-', '/', $d2);
        $d2 = strtotime($d2);

        $days_between = ceil(abs($d2 - $d1) / 86400);

        $rate;
        //improvement rate
        if($days_between == 0){
          $rate = $max_weight - $min_weight;
          echo "<td>" . $rate . " lbs/day</td>";
        }
        else{
          $rate = ($max_weight - $min_weight) / $days_between;
          echo "<td>" . $rate . " lbs/day</td>";
        }
        //date
        echo "<td>From: ".$row_31["MIN(date)"]."<br>To: ".$row_41["MAX(date)"]."</td>";

      }
       ?>
      <!---End of Hsien's mess------------------------------------------------------------------------------------------------------------------------->
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
