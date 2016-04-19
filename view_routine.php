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

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');
}

//Create Exercise object from ID in the URL
$rout_show = Routine::find_by_id($_GET['id']);
if(!$rout_show){
	$session->message("Unable to be find group.");
	redirect_to('profile.php');
}


?>
<?php


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

    <title><?php echo $exercise1->x_description; ?></title>

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

    	<h2>Workout Info</h2>
    	<?php
    		echo "<p>Name: ". $rout_show->name . "<br/>";
			echo "<p>Description: ". $rout_show->description . "<br/>";
			echo "This workout is done on: "."<br>";
			if($rout_show->mon==1)
			{
				echo "Monday"."<br>";
			}
			if($rout_show->tues==1)
			{
				echo "Tuesday"."<br>";
			}
			if($rout_show->wed==1)
			{
				echo "Wednesday"."<br>";
			}
			if($rout_show->thurs==1)
			{
				echo "Thursday"."<br>";
			}
			if($rout_show->fri==1)
			{
				echo "Friday"."<br>";
			}
			if($rout_show->sat==1)
			{
				echo "Saturday"."<br>";
			}
			if($rout_show->sun==1)
			{
				echo "Sunday"."<br>";
			}

			 $total_exercises=$user->find_last_exercise($rout_show->id);

			 foreach ($total_exercises as $exercise_number)
			 {
			 		//echo $rout_show->id;
			 		$temp_ex=Exercises::find_by_id($exercise_number->id);
			 		//echo $temp_ex->type;
			 		//echo $exercise_number->type;
			 		$display_type = Types::find_by_id($temp_ex->type);


					//echo $display_type->id;

					echo "<tr><td><a href='view_exercises.php?id={$exercise_number->id}&rout_id={$rout_show->id}'>".$display_type->name."</a></td><br>";

			 }
			 		//redirect_to("add_routine_exercise.php?id=$a");
					//echo("<button onclick=\"location.href='add_routine_exercise.php?id'\">Back to Home</button>");
					echo "<p><a class='btn btn-default' href='add_routine_exercise.php?id=$rout_show->id' role='button'>Add Exercise</a></p>"
    	?>
    	<p><a class="btn btn-default" href="profile.php" role="button">Go Back to Home</a></p>

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
