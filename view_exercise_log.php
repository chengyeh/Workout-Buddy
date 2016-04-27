<?php
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
$log_obj = Category::find_by_id($_GET['id']);
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
		<?php
			$exercise_name=Exercises::find_by_id($log_obj->exercise_id);
			$type_name=Types::find_by_id($exercise_name->type);
		?>

        <h2>Log History for <?php echo $type_name->name ?> </h2>
       	<?php
       		$log_ex_array=$log_obj->log_exercises1();
       		$a=1;
       		echo "<table class='table'><tr><th>Set</th><th>Actual Reps</th><th>Target Reps</th><th>Actual Weight</th><th>Target Weight</th>";
			while($log_ex_disp = $log_ex_array->fetch_assoc())
			{
				$log_name=Log::find_by_id($log_ex_disp['id']);
				$log_transfer=$log_name->set_log_helper($a);
				$actual_reps=0;
				$actual_weight=0;
				while($log_array = $log_transfer->fetch_assoc())
				{
					$set_array=Set::find_by_id($log_array['id']);
					//echo $set_array->id;
					//echo "<br>";
					//echo $set_array->reps;
					$actual_reps=$set_array->reps;
					//echo "<br>";
					//echo $set_array->weight;
					$actual_weight=$set_array->weight;
					//echo "<br>";
				}

					/*
					echo $actual_reps;
					echo "<br>";
					echo $actual_weight;
					echo "<br>";*/
				echo "<tr>";
				echo "<td>" . "<b>".$a. "</td>";

				echo "<td>" . $log_name->reps . "</td>";
				echo "<td>" . $actual_reps . "</td>";
				echo "<td>" . $log_name->weight . "</td>";
				echo "<td>" . $actual_weight . "</td>";


				$a=$a+1;

				//echo "<td>" . $type_log->name."</td>";


				echo "</tr>";
			}
			echo "</table>";


       	/*
       		//echo $user->id;
       		$a=1;
       		//$log_array=$user->display_log();
       		echo "<table class='table'><tr><th>Date</th><th>Time</th><th>Routine</th><th>Exercise</th><th>Date</th><th class='text-center'>Delete</th></tr>";

				$routine_name=Routine::find_by_id($log_obj->routine_id);
				$exercise_obj=Exercises::find_by_id($log_obj->exercise_id);
				$type_log=Types::find_by_id($exercise_obj->type);
				echo "<tr>";

				$a=$a+1;

				echo "<td>" . $routine_name->name."</td>";
				echo "<td>" . $type_log->name."</td>";
				echo "</tr>";

			echo "<tr><td></td><td></td><td></td><td></td><td></td><td class='text-center'><input type='submit' class='btn btn-default' name ='submit' value='Go Back'></td></tr>";
			echo "</table>";
		*/
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
