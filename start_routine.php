<?php
/**
 * When User clicks start, all exercises of the routine and the sets belong to it are queried from the database and printed in a table.
 * 
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);

//If the id field is empty return the user to profile page
if (empty($_GET['id'])){
	$session->message("No group ID was provided.");
	redirect_to('profile.php');
}

//Create Routine object from id in the URL 
$routine = Routine::find_by_id($_GET['id']);
if(!$routine){
	$session->message("Unable to be find routine.");
	redirect_to('profile.php');
}

//Create User object for routine owner
$routine_owner = User::find_by_id($routine->user_id);

$routine_exercises = $routine->get_exercises();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $errors = array();

    //Trim all the incoming data:
    $trimmed = array_map('trim', $_POST);
    
    date_default_timezone_set('America/Chicago');
    $dt = new DateTime();
    $tz = new DateTimeZone('America/Chicago');
    
    for($i = 1; $i <= $trimmed['sets_length']; $i++)
    {
        $log = new Log();
        $log->user_id = $user->id;
        $log->routine_id = $routine->id;
        $log->exercise_id = $trimmed['exercise_id'];
        $log->exercise_type_id = $trimmed['exercise_type'];
        $log->set_id = $trimmed['set'.$i.'_id'];
        $log->reps = $trimmed['set'.$i.'_rep'];
        $log->weight = $trimmed['set'.$i.'_weight'];
        $log->date = $dt->format('m-d-Y');
        $log->time = $dt->format('H:i:s');
        
        $log->create();
    }
 
    //Redirect to profile page
    // redirect_to("view_routine.php?id={$routine->id}");   
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

    <title>Fixed Top Navbar Example for Bootstrap</title>
    
    <!-- temp style -->
    <style type="text/css">
    /*table, td{
    	border: 1px solid black;
    	text-align: center;
    }*/
    
    input{
        width: 35%;
    }
	</style>

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
    
  	<?php
      	$exercise_number = 1;
      	foreach($routine_exercises as $exercise)
    	{      	    
    		$type = Types::find_by_id($exercise->type);
    		$sets = $exercise->get_sets();
            $sets_length = count($sets);
            $set_number = 1;

    		echo "<form action='#' method='POST'>";
            echo "<input type='hidden' name='exercise_id' value='{$exercise->id}'>";
            echo "<input type='hidden' name='exercise_type' value='{$type->id}'>";
            echo "<input type='hidden' name='sets_length' value='{$sets_length}'>";
    		echo "<table class='table table-bordered'><tr><th></th><th>Name</th><th>Set</th><th>Reps</th><th>Weight</th></tr><tr><td rowspan='3'><img src='images/{$type->image_filename}' width='50%' height='50%'></td><td rowspan='3'>{$type->name}</td>";        		
    		foreach($sets as $set)
    		{
    		    echo "<input type='hidden' name='set{$set_number}_id' value='{$set->id}'>";
    			if($set->order == 1)
    			{
    				echo "<td>{$set->order}</td><td><input type='number' name='set{$set_number}_rep' min='0'>/{$set->reps}</td><td><input type='number' name='set{$set_number}_weight' min='0'>/{$set->weight}</td></tr>";
    			}
    			else{
    				echo "<tr><td>{$set->order}</td><td><input type='number' name='set{$set_number}_rep' min='0'>/{$set->reps}</td><td><input type='number' name='set{$set_number}_weight' min='0'>/{$set->weight}</td></tr>";
    			}
    			
                $set_number++;
    		}
    		echo "</table>";
    		echo "<button type='submit' name='next' class='btn btn-primary'>NEXT</button></form><br>";
            
            $exercise_number++;
    	}	
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
