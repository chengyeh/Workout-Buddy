<?php
ob_start();
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

$session->logout();
redirect_to("login.php");
?>
<html>
<head>
	<title>Workout Buddy: Logout</title>
	
</head>
	<body>
	<h1>Logout</h1>
	</body>
</html>