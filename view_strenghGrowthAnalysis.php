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


<html>
<head>
</head>
  <body>
  </body>
</html>
