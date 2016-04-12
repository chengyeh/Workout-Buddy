<?php
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in; if not, throw it back to login page
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  $trimmed = array_map('trim', $_POST);

  $sga = new strenghGrowthAnalysis();
  $user = $trimmed['user_id'];
  $sql = "SELECT * FROM strenghGrowthAnalysis WHERE who LIKE '". $user . "';";

  //if the user have not created a record before
  /*
    now the mysqli_num_rows seems to be always less than 1, or == 0, check it out later.
  */
  if(mysqli_num_rows($sql) > 0){
    //if the user has created a record before
      $sql = "SELECT * FROM strenghGrowthAnalysis WHERE bench_press_now != 0.0 AND who LIKE '". $trimmed['user_id'] . "';";
      //if the user has updated before; anything that has _now must has value

      //if the user has not been updated before; _now does not have value
      if(mysqli_num_rows($sql) == 0){
        $sga->who = $trimmed['user_id'];
        $sga->bench_now = $trimmed['sga_BP_lbs'];
        $sga->pull_up_now = $trimmed['sga_pull_up'];
        $sga->treadmill_now = $trimmed['sga_tmm'];
        $sga->update();
      }
  }
  else{
    $sga->who = $trimmed['user_id'];
    $sga->bench_press_previous = $trimmed['sga_BP_lbs'];
    $sga->pull_up_previous = $trimmed['sga_pull_up'];
    $sga->treadmill_previous = $trimmed['sga_tmm'];
    $sga->create();
  }

  //Redirect to profile page
  redirect_to("view_group.php?id={$database->insert_id()}");
}//end if
?>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Workout Buddy: Strength Analysis</title>
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
    <div class="col-xs-12 col-sm-6 col-md-8">

    <h1>Profile Page: Update your strength growth</h1>
    <p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>
    <h2>User Info</h2>
  	<?php
  		echo "<p>User Name: " . $session->user_name. "</p>";
  		echo "<p>User Id: " . $session->user_id . "</p>";
  	?>

    <h2>Update your strength</h2>
      <table>
        <form action="#" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
        <tr><td><label>Your current bench press (lbs):</label></td><td><input type="text" name="sga_BP_lbs" required /></td></tr>
        <tr><td><label>You current max numbers of pull ups (#):</label></td><td><input type="text" name="sga_pull_up" required /></td></tr>
        <tr><td><label>Your current longest run (miles):</label></td><td><input type="text" name="sga_tmm" required /></td></tr>
        <tr><td><button type="submit" name="submit">Update your strength growth! WooHoo</button></td><td></td></tr>
      </table>
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
