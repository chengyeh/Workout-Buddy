<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);

//Get all the group activity to popluate the
//select box in form
$group_activity = Group::get_activity();

?>

<?php
$search_string;

if(isset($_GET['submit'])){
  $search = array();
  $activity = $database->escape_value($_GET['group_activity']);
  if(isset($activity)&& (!empty($activity)|| $activity !=0)){
    $search_string = " group_activity LIKE '%{$activity}%' ";
  }elseif (!isset($activity) || (empty($activity) || $activity==0)){
    $message = "Check your search name.";
  }
}

if(isset($search_string) && empty($message)){
	//Asemble sql statement
	$sql = "SELECT * FROM wb_group ";
	$sql .= "WHERE {$search_string} AND  group_status='Public' ";
	$sql .= "ORDER BY group_name ASC ";
	
	$groups = Group::find_by_sql($sql);
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
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="addChallenges.php">Add Challenge</a></li>
                <li><a href="#">One more separated link</a></li>
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
  	<!-- Two coloum layout -->
  	<!-- First coloum: Search box -->
  	<div class="col-md-3">
  	<h2>Search</h2>
  	<form action="find_group.php" method="get">
  		<fieldset class="form-group">
		   <label for="formGroupExampleInput">Search by Activity</label>
		   <select name="group_activity" class="form-control" required>
		   <?php 
		   		echo "<option value=''></option>";
		   		foreach ($group_activity as $key => $value){
					echo "<option value='{$value}'>{$value}</option>";
				}		   
		   ?>	  
			</select>
		</fieldset>
		<button type="submit" name="submit" class="btn btn-default">Search</button>
  	</form>
  	</div>
  	
  	<!-- Second coloum: Search results -->
  	<div class="col-md-9">
  	
  	<?php 
  		if(isset($groups)){
			echo "<h2>Search Results for {$activity}</h2>";
	  		if(!empty($groups)){
				echo "<table class='table'>";
		  		echo "<tr><th>Name</th><th>Discription</th><th></th></tr>";
		  		foreach ($groups as $group){
					echo "<tr><td>{$group->group_name}</td><td>{$group->group_discription}</td><td class='text-center'><a class='btn btn-sm btn-success' href='add_public_group_member.php?user_id={$session->user_id}&group_id={$group->id}' role='button'>Join</a></td></tr>";
				}
				echo "</table>";
			}else{
				echo "<h3>No groups found.</h3>";
			}
		}
  	?>
  	</div>
  	
  	
  	
  	
  	
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
