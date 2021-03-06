<?php
// Workout Buddy Manual
// 
//    
// Copyright (C) <2016>  <Paul Charles, Kuei-Hsien Chu, Purna Doddapaneni, Dilesh Fernando, Cheng-Yeh Lee>
// 
// This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.
// 
// You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
?>
<?php
/*
 *	@file login.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments log the user to the site.
*/

//Include initialization file
require_once('includes/initialize.php');

$error_message;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = $database->escape_value($_POST['email']);
	} else {
		$e = FALSE;
		$error_message = "You forgot to enter your email address!";
	}
	
	// Validate the password:
	if (!empty($_POST['password'])) {
		$p = $database->escape_value($_POST['password']);
	} else {
		$p = FALSE;
		$error_message = "You forgot to enter your password!";
	}
	
	if ($e && $p) { // If everything's OK.

		// Query the database:
		$found_user = User::authenticate($e, $p);
		
		if ($found_user) { // A match was made
			// Register the values:
			$session->login($found_user);
		    
		    //log_action('Login', "{$found_user->username} logged in.");
		    
			redirect_to("profile.php");
				
		} else { // No match was made.
			$error_message = "Either the email address and password entered do not match those on file or you have not yet activated your account.";
		}
		
	} else { // If everything wasn't OK.
		$error_message = "Please try again.";
	}
	
} // End of SUBMIT conditional.
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

    <title>Workout Buddy - Login</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/signin.css" rel="stylesheet">

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

    <div class="container">
    <?php 
		//If error, display error.
		if(isset($error_message)){
			echo "<div class='alert alert-danger' role='alert'>".$error_message."</div>";
		}
	 ?>
    
	  <a href="index.html"><img alt="workout buddy logo" src="images/Workout_Buddy_Logo.png" class="center-block"></a>
      <form class="form-signin" action="login.php" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Sign In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password"  name="password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
        <br/>
        <p><a class="btn btn-lg btn-success btn-block" href="signup.php" role="button">Sign up</a></p>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
