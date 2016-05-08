<?php
/**
 * When User clicks on Add Exercise, all exercise types are queried from he database and printed in a drop-down list.
 *@pre: routine object created, user session
 *@post: exercise sets to be created
 *@return: exercise id and type id
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);
if (empty($_GET['id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');

}

//Create Routine object from id in the URL in which to create the routine associted with the exercise
$addexercise = Routine::find_by_id($_GET['id']);
//Creates the abilty to obtain types
$var_types = Types::find_by_id(1);
if(!$addexercise)
{
	$session->message("Unable to be find group.");
	redirect_to('login.php');
}


?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  //Trim all the incoming data:
    $trimmed = array_map('trim', $_POST);


            // Obtains the front-end fields
            if(isset($_POST['select_type']))
            {
            	$answer=$_POST['select_type'];
            }

            $type_input = new Types();
            $type_input->routine_id = $addexercise->id;
            $type_input->type = $answer;


			//Logic used to obtain information and create the following exercises
			 $total_exercises=$user->find_last_exercise($addexercise->id);
			//$q is used to find the final next exercise
			 $q=0;
			 foreach ($total_exercises as $exercise_number)
			 {
			 		echo $q;
					$b=$exercise_number->id;
					if($b > $q)
					{
						$q=$b;
					}

			}

			$a=$type_input->routine_id;

			 redirect_to("add_exercise_set.php?rout_id=".$a."&type_id=".$answer);

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

    <title>Workout Buddy - Add Exercise</title>

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
    <h2>Add Exercise</h2>
   	<?php
   			//This queries from the routine associated with the exercise
   			echo "<p><strong>Name: </strong>". $addexercise->name . "<br/>";
			echo "<p><strong>Description: </strong>". $addexercise->description . "<br/>";

			//This is user input for the exercise type choice
		   	echo "<form action='#' method='POST'>";
		   		echo "<select name='select_type'>";
				$display_types=$var_types->show_types();
				$a=1;
				foreach($display_types as $display_feature)
				{
					echo '<option value="'.$a.'">'.$display_feature->name.'</option>';
					$a=$a+1;
				}
				echo "</select>";
				echo "</br>";
		   	echo "<button type='submit' name='submit' class='btn btn-success'>Create Exercise</button>";
		   	echo "</br>";
		   	echo "</form>";
		   	echo "<br>";
			echo "<p><a class='btn btn-primary'  href='view_routine.php?id=$addexercise->id' role='button'>Back to Routine</a></p>";

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
