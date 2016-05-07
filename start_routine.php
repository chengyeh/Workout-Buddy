<?php
/**
 * When User clicks start, all exercises of the routine and the sets belong to it are queried from the database and printed in a table.
 *
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

$number_messages=0;

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

// Create User object for the current session user.
$user = User::find_by_id($session->user_id);

// If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
	$session->message("No routine ID was provided.");
	redirect_to('profile.php');
}

// Create Routine object from id in the URL
$routine = Routine::find_by_id($_GET['id']);
if(!$routine){
	$session->message("Unable to be find routine.");
	redirect_to('profile.php');
}

// Redirect to profile page if current user is not the owner of this routine
if($user->id != $routine->user_id){
    $session->message("Unable to be find routine.");
    redirect_to('profile.php');
}

// Get the current page number
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

// Records per page
$per_page = 1;

// Get the total count of exercise
$sql = "SELECT COUNT(*) FROM wb_exercise WHERE routine_id=".$routine->id;
$result_set = $database->query($sql);
$row = $database->fetch_array($result_set);
$total_count = array_shift($row);

// If there is not exercise in this routine, redirect to view_routine.php
if($total_count == 0){
    $session->message("No exercise in routine.");
    redirect_to("view_routine.php?id={$routine->id}");
}

$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$routine->id." ORDER BY id ASC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$exercises = $database->query($sql);

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $errors = array();

    if ($_POST['action'] == 'END WITHOUT SAVE')
    {
        // Redirect to view routine page
        redirect_to("view_routine.php?id={$routine->id}");
    }

    // Trim all the incoming data:
    $trimmed = array_map('trim', $_POST);

    date_default_timezone_set('America/Chicago');
    $dt = new DateTime();
    $tz = new DateTimeZone('America/Chicago');

    $category1 = new Category();
    $category1->user_id=$user->id;
    $category1->routine_id=$routine->id;;
    $category1->exercise_id = $trimmed['exercise_id'];
    $category1->Date = $dt->format('m-d-Y');
    $category1->Time = $dt->format('H:i:s');
    $category1->create();

	// Create data in wb_user_log table depends on the number of set
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
        $log->category_id = $category1->id;
        $log->create();
    }

    if ($_POST['action'] == 'END')
    {
        // Redirect to view routine page
        redirect_to("view_routine.php?id={$routine->id}");
    }
    else if($_POST['action'] == 'NEXT')
    {
        // Redirect to next exercise
        redirect_to("start_routine.php?id={$routine->id}&page={$pagination->next_page()}");
    }
    else
    {
        // Redirect to view routine page
        redirect_to("view_routine.php?id={$routine->id}");
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

    <title><?php echo $routine->name; ?></title>

    <!-- input and button style -->
    <style type="text/css">
	    input{
	        width: 15%;
	    }
	
	    #button{
	        width: 100%;
	        max-width: 100%;
	        height: 40px;
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
	            	// Query unread messages from the wb_messages table and display the count.
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

  	<?php
        while ($row = mysqli_fetch_array($exercises))
        {
            $exercise = Exercises::find_by_id($row['id']);
            $type = Types::find_by_id($exercise->type);
            $sets = $exercise->get_sets();
            $sets_length = count($sets);
            $set_number = 1;

            echo "<h1>".$type->name."</h1><br/>";
            echo "<form action='#' method='POST'>";
            echo "<input type='hidden' name='exercise_id' value='{$exercise->id}'>";
            echo "<input type='hidden' name='exercise_type' value='{$type->id}'>";
            echo "<input type='hidden' name='sets_length' value='{$sets_length}'>";

            echo "<table style='width: 100%; max-width: 100%;'><tr><td><img src='images/{$type->image_filename}' width='50%' height='50%'></td></tr></table><br>";
            echo "<table class='table table-bordered'><tr><th>SET #</th><th>REPS</th><th>LBS</th></tr>";
			
			// For each set, display its order, target reps, and target weight. The user can fill out the actual reps and weight as they work out  
            foreach($sets as $set)
            {
                echo "<input type='hidden' name='set{$set_number}_id' value='{$set->id}'>";
                if($set->order == 1)
                {
                    echo "<td>{$set->order}</td><td><input type='number' name='set{$set_number}_rep' min='0'> / {$set->reps}</td><td><input type='number' name='set{$set_number}_weight' min='0'> / {$set->weight}</td></tr>";
                }
                else
                {
                    echo "<tr><td>{$set->order}</td><td><input type='number' name='set{$set_number}_rep' min='0'> / {$set->reps}</td><td><input type='number' name='set{$set_number}_weight' min='0'> / {$set->weight}</td></tr>";
                }

                $set_number++;
            }
            echo "</table>";

			// If there is at least one page 
            if($pagination->total_pages() > 0)
            {
            	// If there is next page, display "END WITHOUT SAVE", "END", and "Next" buttons
                if($pagination->has_next_page())
                {
                    echo "<table class='table'><tr><td><input type='submit' id='button' class='btn btn-warning' name='action' value='END WITHOUT SAVE' /></td><td class='text-center'><input type='submit' id='button' class='btn btn-danger' name='action' value='END' /></td>";
                    echo "<td class='text-right'><input type='submit' id='button' class='btn btn-primary' name='action' value='NEXT' /></td></tr></table></form>";
                }
                else // If it's at the last page display "END WITHOUT SAVE" and "YOU'VE DONE IT!" buttons
                {
                    echo "<table class='table'><tr><td><input type='submit' id='button' class='btn btn-warning' name='action' value='END WITHOUT SAVE' /></td>";
                    echo "<td class='text-right'><input type='submit' id='button' class='btn btn-success' name='action' value=\"YOU'VE DONE IT!\" /></td></tr></table></form>";
                }
            }
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
