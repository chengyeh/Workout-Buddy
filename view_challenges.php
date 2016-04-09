<?php
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);
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

    <title>Workout Buddy: View Challenge</title>

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
    <h1>Challenge Leaderboard</h1>
    <hr>
      <!---Display current leader board--->
      <center>
      <table>
      <?php

          if($result = challenge::bp_top3()){
              echo "<tr><td><h5>BENCH PRESS</h5></td><td><h5>TOP 3</h5></td><tr>";
              echo "<tr><td></td><td>lbs</td>";
              while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" .$row["name"]  . "</td>";
                echo "<td>" .$row["bench_press"] . "</td>";
                echo "</tr>";
            }
            $result->free();
          }//end if
          else{
            echo "Looks like no one bench press more than 200lbs";
          }
          echo "<tr><td>---------------------------</td><td>-----------------</td></td>";
          if($result = challenge::pu_top3()){
              echo "<tr><td><h5>PULL UPs</h5></td><td><h5>TOP 3</h5><td><tr>";
              echo "<tr><td></td><td>numbers</td>";
              while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" .$row["name"]  . "</td>";
                echo "<td>" .$row["pull_ups"] . "</td>";
                echo "</tr>";
            }
            $result->free();
          }//end if
          else{
            echo "Looks like no one bench press more than 200lbs";
          }
          echo "<tr><td>---------------------------</td><td>-----------------</td></td>";
          if($result = challenge::tm_top3()){
              echo "<tr><td><h5>Treadmill</h5></td><td><h5>TOP 3</h5><td><tr>";
              echo "<tr><td></td><td>miles</td>";
              while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" .$row["name"]  . "</td>";
                echo "<td>" .$row["treadmill_mileage"] . "</td>";
                echo "</tr>";
            }
            $result->free();
          }//end if
          else{
            echo "Looks like no one bench press more than 200lbs";
          }
       ?>
       </table>
       </center>

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