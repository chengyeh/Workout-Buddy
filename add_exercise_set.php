<?php
/**
 * When User clicks on a group, all members of the group and the groups activity are queried from he database and printed in a table. If the user id matches that of the owner of the group, adminstrative priveleges are granted and the owner can delete members.
 *
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
$addtype = $_GET['type_id'];

/*$var_types = Types::find_by_id(1);*/
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

			$new_set = new Set();
           	$new_set->routine_id = $addexercise->id;
           	$a=$new_set->routine_id;
         	$monday=isset($_POST['mon']);
         	$set1_reps=$_POST['set1_reps'];
         	$set2_reps=$_POST['set2_reps'];
         	$set3_reps=$_POST['set3_reps'];
         	$set1_weight=$_POST['set1_weight'];
         	$set2_weight=$_POST['set2_weight'];
         	$set3_weight=$_POST['set3_weight'];
         	/*
         	echo $set1_reps;
         	echo "<br>";
         	echo $set2_reps;
         	echo "<br>";
         	echo $set3_reps;
         	echo "<br>";
         	echo $set1_weight;
         	echo "<br>";
         	echo $set2_weight;
         	echo "<br>";
         	echo $set3_weight;
         	echo "<br>";
         	echo $new_set->exercise_id;
         	echo "<br>";
         	echo $new_set->routine_id;
         	*/
         	$database->query("INSERT INTO `wb_exercise`(`routine_id`, `type`) VALUES ($new_set->routine_id,$addtype)");

			 $total_exercises=$user->find_last_exercise($addexercise->id);

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

         	$database->query("INSERT INTO `wb_exercise_set`(`exercise_id`, `routine_id`, `order`, `reps`, `weight`) VALUES ($q,$new_set->routine_id,1,$set1_reps,$set1_weight)");
			 $database->query("INSERT INTO `wb_exercise_set`(`exercise_id`, `routine_id`, `order`, `reps`, `weight`) VALUES ($q,$new_set->routine_id,2,$set2_reps,$set2_weight)");
			 $database->query("INSERT INTO `wb_exercise_set`(`exercise_id`, `routine_id`, `order`, `reps`, `weight`) VALUES ($q,$new_set->routine_id,3,$set3_reps,$set3_weight)");
			 redirect_to("add_routine_exercise.php?id=$a");
			 /*
			 $total_routines=$user->find_last_routine();
			 $a=0;
			 foreach ($total_routines as $routine_number)
			 {
					$b=$routine_number->id;
					if($b > $a)
					{
						$a=$b;
					}
			  }
			echo $a;	*/


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

    <title></title>

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
            <li><a href="#about">About</a></li>
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
            <li><span ><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp Hi <?php echo $session->user_name; ?>!&nbsp &nbsp<a class="btn btn-primary btn-sm" href="logout.php" role="button">Logout</a></span>
        </div><!--/.nav-collapse -->
      </div>

    </nav>

    <div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <h2>Exercise Agenda</h2>
   	<?php
   			echo "<p>Workout: ". $addexercise->name . "<br/>";
   			//echo $addtype->type."<br>";

   			$actual_name=Types::find_by_id($addtype);

   			echo $actual_name->name;

   			echo "<form action='#' method='POST'>";
		   		echo "<select name='select_set'>";


				for($i=1; $i <=5; $i++)
				{
					echo '<option value="'.$i.'">'.$i.'</option>';

				}
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
		   	echo "<button type='submit' name='submit' class='btn btn-default'>Create Agenda</button>";
		   	echo "</form>";
   			echo "<p><a class='btn btn-default' href='add_routine_exercise.php?id=$addexercise->id' role='button'>Back to Exercise</a></p>";
   			/*
			echo "<p>Descripiton: ". $addexercise->description . "<br/>";
			echo "<p>ID: ". $addexercise->id . "<br/>";
			echo "<p>exercise Name: ". $addtype->id . "<br/>";
			echo "<p>Descripiton: ". $addtype->routine_id . "<br/>";
			echo "<p>ID: ". $addtype->type . "<br/>";
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
