<?php
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in; if not, throw it back to login page
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//$challenge = challenge::find_by_id($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  //Redirect to profile page
  redirect_to("view_group.php?id={$database->insert_id()}");
}//end if
?>


<html>
  <head>
    <title>Workout Buddy: Strength Analysis</title>
  </head>

  <body>

  </body>
</html>
