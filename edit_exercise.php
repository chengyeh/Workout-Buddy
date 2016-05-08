<?php
/**
 * This class is used to edit exercise by altering the fields of the object
 * @pre: pre-made exercise object as well as exercise set objective
 * @post: Database access
 * @return: Same exercise object id
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);
if (empty($_GET['rout_id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');

}

//Create Exercise object from ID in the URL
$addexercise = Routine::find_by_id($_GET['rout_id']);
//Create exercise object from previous exercise id to be edited
$addtype = Exercises::find_by_id($_GET['ex_id']);
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

			//Edits new incoming set data
			$new_set = new Set();
            $new_set->exercise_id = $addtype->id;
           	$new_set->routine_id = $addexercise->id;
           	$a=$new_set->routine_id;
         	$monday=isset($_POST['mon']);
         	$set1_reps=$_POST['set1_reps'];
         	$set2_reps=$_POST['set2_reps'];
         	$set3_reps=$_POST['set3_reps'];
         	$set1_weight=$_POST['set1_weight'];
         	$set2_weight=$_POST['set2_weight'];
         	$set3_weight=$_POST['set3_weight'];

					//$trigger_querry determines if the workout gets queried or not based on valid input
					$trigger_query=0;

         	if(empty($set1_reps) || empty($set2_reps) || empty($set3_reps) || empty($set1_weight) || empty($set2_weight) || empty($set3_weight))
         	{
         		if(empty($set1_reps))
         		{
         			$set1_reps=0;
         		}
         		if(empty($set2_reps))
         		{
         			$set2_reps=0;
         		}
         		if(empty($set3_reps))
         		{
         			$set3_reps=0;
         		}
         		if(empty($set1_weight))
         		{
         			$set1_weight=0;
         		}
         		if(empty($set2_weight))
         		{
         			$set2_weight=0;
         		}
         		if(empty($set3_weight))
         		{
         			$set3_weight=0;
         		}
         		$trigger_query=1;

         	}
         	else
         	{
         		$trigger_query=1;
         	}
         	if(((!empty($set2_reps)) && (!is_numeric($set2_reps))) || ((!empty($set1_reps)) && (!is_numeric($set1_reps))) || ((!empty($set3_reps)) && (!is_numeric($set3_reps))))
         	{
         		$trigger_query=3;

         	}

         	if(((!empty($set2_weight)) && (!is_numeric($set2_weight))) || ((!empty($set1_weight)) && (!is_numeric($set1_weight))) || ((!empty($set3_weight)) && (!is_numeric($set3_weight))))
         	{
         		$trigger_query=3;

         	}

			if(($set1_reps < 0) || ($set2_reps < 0) || ($set3_reps < 0) || ($set1_weight < 0) || ($set2_weight < 0) || ($set3_weight < 0))
			{
				$trigger_query=2;
			}

         	if($trigger_query==1)
         	{
		         	$a=1;
		         	$b=2;
		         	$c=3;

		         	$database->query("UPDATE `wb_exercise_set` SET `reps`=$set1_reps, `weight`=$set1_weight WHERE exercise_id=".$new_set->exercise_id." AND `order`=".$a." AND routine_id=".$new_set->routine_id);
					$database->query("UPDATE `wb_exercise_set` SET `reps`=$set2_reps, `weight`=$set2_weight WHERE exercise_id=".$new_set->exercise_id." AND `order`=".$b." AND routine_id=".$new_set->routine_id);
					$database->query("UPDATE `wb_exercise_set` SET `reps`=$set3_reps, `weight`=$set3_weight WHERE exercise_id=".$new_set->exercise_id." AND `order`=".$c." AND routine_id=".$new_set->routine_id);
					redirect_to("view_exercises.php?id=$addtype->id&rout_id=$addexercise->id");
         	}
         	else
         	{

         		if($trigger_query==2)
				{
					echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button>";
					echo "<strong>Warning:</strong> Please give values above 0.";
					echo "</div>";
				}
				else if($trigger_query==3)
				{
					echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button>";
					echo "<strong>Warning:</strong> Please give numeric values.";
					echo "</div>";
				}
				else
				{
					echo "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>&times;</button>";
					echo "<strong>Warning:</strong> Please give valid values.";
					echo "</div>";
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

    <title>Workout Buddy - Edit Exercise</title>

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
    <h2>Exercise Agenda</h2>
   	<?php
   			//This queries from the routine associated with the exercise that is to be edited
   			echo "<p><strong>Workout: </strong>". $addexercise->name . "<br/>";

			//This is the exercise type of the exercise that is to be edited
   			$actual_name=Types::find_by_id($addtype->type);

   			echo "<strong>".$actual_name->name."</strong>";

			//This is user input for the exercise form that is to be edited
   			echo "<form action='#' method='POST'>";

				echo "</select>";
				echo "<br><label>Set 1:  </label>";
				echo "<br>";
				echo "Reps <input type='text' name='set1_reps'>";
				echo "Weight <input type='text' name='set1_weight'>";
				echo "<br>";
				echo "<label>Set 2:  </label>";
				echo "<br>";
				echo "Reps <input type='text' name='set2_reps'>";
				echo "Weight <input type='text' name='set2_weight'>";
				echo "<br>";
				echo "<label>Set 3:  </label>";
				echo "<br>";
				echo "Reps <input type='text' name='set3_reps'>";
				echo "Weight <input type='text' name='set3_weight'>";
				echo "<br>";
				echo "<br>";
		   	echo "<button type='submit' name='submit' class='btn btn-success'>Update Agenda</button>";
		   	echo "</form>";
   			echo "<p><a class='btn btn-primary' href='view_exercises.php?id=$addtype->id&rout_id=$addexercise->id' role='button'>Back to Exercise</a></p>";
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
