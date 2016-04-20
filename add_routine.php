<?php

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
<<<<<<< HEAD
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
	
	echo $rout->start_date ."<br/>";
	echo $rout->end_date ."<br/>";
	
	$startDate = $rout->start_date;
	$endDate = $rout->end_date;
	
	$rout->create();
				
	if ($database->affected_rows() == 1) {
		//Routine added to the table
		//Add routine to calendar
		
		for ($i = strtotime($startDate); $i <= strtotime($endDate); $i = strtotime('+1 day', $i)) {
			if (date('N', $i) == 1 && $rout->mon == 1) //Monday == 1
				echo date('l Y-m-d', $i). "<br/>";
			if (date('N', $i) == 2 && $rout->tues == 1) //Tuesday == 1
				echo date('l Y-m-d', $i). "<br/>";
			if (date('N', $i) == 3 && $rout->wed == 1) //Wenesday == 1
				echo date('l Y-m-d', $i). "<br/>";
			if (date('N', $i) == 4 && $rout->thurs == 1) //Thursday == 1
				echo date('l Y-m-d', $i). "<br/>";
			if (date('N', $i) == 5 && $rout->fri == 1) //Friday == 1
				echo date('l Y-m-d', $i). "<br/>";
			if (date('N', $i) == 6 && $rout->sat == 1) //Saturday == 1
				echo date('l Y-m-d', $i). "<br/>";
			if (date('N', $i) == 7 && $rout->sun == 1) //Sunday == 1
				echo date('l Y-m-d', $i). "<br/>";
		}
		
		echo 'Routine created';
		redirect_to("add_routine_exercise.php?id=".$database->insert_id());
	} 
	else { // If it did not run OK.
		echo 'Routine not created';
	}
			
=======
  $errors = array();

  //Trim all the incoming data:
    $trimmed = array_map('trim', $_POST);


            // Add the group member to the database:

            $name=$_POST['routine_name'];
            $desc=$_POST['routine_description'];
            $monday=isset($_POST['mon']);
            $tuesday=isset($_POST['tues']);
            $wednesday=isset($_POST['wed']);
            $thursday=isset($_POST['thurs']);
            $friday=isset($_POST['fri']);
            $saturday=isset($_POST['sat']);
            $sunday=isset($_POST['sun']);
            if(empty($name) || empty($desc) || (empty($monday) && empty($tuesday) && empty($wednesday) && empty($thursday) && empty($friday) && empty($saturday) && empty($sunday)))
            {
            	echo "***Fields Missing***";
            	if(empty($name))
            	{
            		echo "***Fill in Name***";
            	}

            	if(empty($desc))
            	{
            		echo "***Fill in Description***";
            	}

            	if(empty($monday) && empty($tuesday) && empty($wednesday) && empty($thursday) && empty($friday) && empty($saturday) && empty($sunday))
            	{
            		echo "***Fill in Day(s) to Work out***";
            	}
            }
            else
            {
	            $rout = new Routine();
	            $rout->user_id = $user->id;
	            $rout->name = $trimmed['routine_name'];
	            $rout->description = $trimmed['routine_description'];
	            if(empty($monday))
				{

					$rout->mon = 0;
				}
				else
				{

					$rout->mon = 1;
				}

	         	if(empty($tuesday))
				{

					$rout->tues = 0;
				}
				else
				{

					$rout->tues = 1;
				}

	         	if(empty($wednesday))
				{

					$rout->wed = 0;
				}
				else
				{

					$rout->wed = 1;
				}

	         	if(empty($thursday))
				{

					$rout->thurs = 0;
				}
				else
				{

					$rout->thurs = 1;
				}

	         	if(empty($friday))
				{

					$rout->fri = 0;
				}
				else
				{

					$rout->fri = 1;
				}

	         	if(empty($saturday))
				{

					$rout->sat = 0;
				}
				else
				{

					$rout->sat = 1;
				}

	         	if(empty($sunday))
				{

					$rout->sun = 0;
				}
				else
				{

					$rout->sun = 1;
				}
	         	$database->query("INSERT INTO `wb_routine`(`user_id`, name, description, `mon`, `tues`, `wed`, `thurs`, `fri`, `sat`, `sun`) VALUES ($rout->user_id,'$rout->name','$rout->description',$rout->mon,$rout->tues,$rout->wed,$rout->thurs,$rout->fri,$rout->sat,$rout->sun)");
				 /*$routine1=$database->query("SELECT * FROM wb_routine ORDER BY id DESC LIMIT 1");*/
				 /*$exercises_added=$user->exercises_added();*/
				 $total_routines=$user->find_last_routine();
				 /*foreach ($exercises_added as $exercise_row)*/
				 $a=0;

				 foreach ($total_routines as $routine_number)
				 {

						$b=$routine_number->id;
						if($b > $a)
						{
							$a=$b;
						}

				}
				echo $a;
				redirect_to("add_routine_exercise.php?id=$a");
            }



>>>>>>> 02837b53ae42a2b782af0758ffc5b443ba614894
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
    <h2>Exercises</h2>
   	<?php
   	echo "<form action='#' method='POST'>";
	echo "<br>";
	echo "<label>Name:</label>";
	echo "<br>";
	echo "<input type='text' name='routine_name'>";
	echo "<br>";
	echo "<label>Description</label>";
	echo "<br>";
	echo "<input type='text' name='routine_description'>";
	echo "<br>";
	echo "<label>Monday</label>";
	echo "<input type='checkbox' name='mon' value='0'>";
	echo "<br>";
	echo "<label>Tuesday</label>";
	echo "<input type='checkbox' name='tues' value='0'>";
	echo "<br>";
	echo "<label>Wednesday</label>";
	echo "<input type='checkbox' name='wed' value='0'>";
	echo "<br>";
	echo "<label>Thursday</label>";
	echo "<input type='checkbox' name='thurs' value='0'>";
	echo "<br>";
	echo "<label>Friday</label>";
	echo "<input type='checkbox' name='fri' value='0'>";
	echo "<br>";
	echo "<label>Saturday</label>";
	echo "<input type='checkbox' name='sat' value='0'>";
	echo "<br>";
	echo "<label>Sunday</label>";
	echo "<input type='checkbox' name='sun' value='0'>";
	echo "<br>";

   	echo "<button type='submit' name='submit' class='btn btn-default'>Submit Routine</button>";
   	echo "</form>";
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
