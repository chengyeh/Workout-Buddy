<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

	if(!empty($_POST['delete_group']))
	{
		foreach($_POST['delete_group'] as $group_id)
		{
			$group = Group::find_by_id($group_id);
			$group->delete();
			$database->query("DELETE FROM wb_group_members WHERE group_id = '" . $group_id . "'");
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
    <meta name="author" content="Kuei Chu" >
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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
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
  	<p>Main content goes here</p>
	<h1>Profile Page</h1>
	<p><a href="logout.php">logout</a></p>
	<h2>User Info</h2>
	<?php
		echo "<p>User Name: ". $user->full_name() . "<br/>";
		echo "<p>User Id: " . $session->user_id . "</p>";
	?>

	<h2>User Groups</h2>
	<form action="#" method="post">
	<?php
		$groups = $user->find_groups();
		if(!empty($groups)){
			echo "<table><tr><th>Name</th><th>Delete</th></tr>";
				foreach ($groups as $group){
					echo  "<tr><td><a href='view_group.php?id={$group->id}'>".$group->group_name."</a></td>";
					echo "<td style='text-align:center'><input type='checkbox' name='delete_group[]' value='" . $group->id . "'></td></tr>";
				}
			echo "<tr><td colspan='2' style='text-align:right'><button type='submit' name ='delete'>Delete</button></td></tr></table>";
		}else{
			echo  "No groups<br/>";
		}
	?>
	</form>
	<p><a href="add_group.php">Add Group</a></p>

  <p><a href="addChallenges.php">Add Challenge</a>|<a href="view_challenges.php">View Challenge</a><p>

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

