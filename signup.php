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
 *	@file show_calendar_event.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Sign up user to site.
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

//Include initialization file
require_once('includes/initialize.php');
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  	//Keep track of errors 
  	$errors = array();

  	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$fn = $ln = $e = $p = FALSE;
    
    // Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = $database->escape_value($trimmed['first_name']);
	} else {
		$errors[] = '<p class="error">Please enter your first name!</p>';
	}

	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = $database->escape_value($trimmed['last_name']);
	} else {
		$errors[] =  '<p class="error">Please enter your last name!</p>';
	}
	
	// Check for an email address:
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = $database->escape_value($trimmed['email']);
	} else {
		$errors[] =  '<p class="error">Please enter a valid email address!</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password']) ) {
		if ($trimmed['password'] == $trimmed['confirm_password']) {
			$p = $database->escape_value($trimmed['password']);
		} else {
			$errors[] =  '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		$errors[] =  '<p class="error">Please enter a valid password!</p>';
	}

  
  	if ($fn && $ln && $e && $p) { // If everything's OK...

		// Make sure the email address is available:
		$q = "SELECT id FROM wb_users WHERE email='$e'";
		$r = $database->query ($q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($database));
		
		if ($database->num_rows($r) == 0) { // Available.

			// Create the activation code:
			$a = md5(uniqid(rand(), true));

			// Add the user to the database:
			//create user object and assign class variables
			$user = new User();
		    $user->hashed_password = sha1($p);
		    $user->first_name = $fn;
		    $user->last_name = $ln;
		    $user->email = $e;
		    $user->active = 1;
		    $user->activation_code = $a;
		    $user->registration_date = date("Y-m-d H:i:s");

		    //create user
		    $user->create();

			if ($database->affected_rows() == 1) { // If it ran OK.
				
// 				// Send the email: Is not used due security concerns
// 				// mostly the same variables as before
// 				// ($to_name & $from_name are new, $headers was omitted)
// 				$to_name = $fn;
// 				$to = $e;
// 				$subject = "Account activation " . strftime("%T", time());
// 				$message = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
// 				$message .= 'http://people.eecs.ku.edu/~dfernand/eecs448/EECS448_Project3/' . 'activate.php?x=' . urlencode($e) . "&y={$a}";
// 				$message = wordwrap($message,70);
// 				$from_name = "Workout Buddy";
// 				$from = "";
				
// 				// PHPMailer's Object-oriented approach
// 				$mail = new PHPMailer();
				
// 				// Can use SMTP
// 				// comment out this section and it will use PHP mail() instead
// 				$mail->IsSMTP();
				
// 				// Could assign strings directly to these, I only used the
// 				// former variables to illustrate how similar the two approaches are.
// 				$mail->FromName = $from_name;
// 				$mail->From     = $from;
// 				$mail->AddAddress($to, $to_name);
// 				$mail->Subject  = $subject;
// 				$mail->Body     = $message;
				
// 				$result = $mail->Send();
				
				// Finish the page:
				redirect_to("login.php");
				
			} else { // If it did not run OK.
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
			
		} else { // The email address is not available.
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}
		
	} else { // If one of the data tests failed.
      foreach ($errors as $item) {
      echo $item;
    }
		echo '<p class="error">Please try again.</p>';
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

    <title>Workout Buddy - Sign Up</title>

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
	  <a href="index.html"><img alt="workout buddy logo" src="images/Workout_Buddy_Logo.png" class="center-block"></a>
      <form class="form-signin" action="signup.php" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Please Sign Up</h2>
        <label for="inputFirstName" class="sr-only">First Name</label>
        <input type="text" id="inputFirstName" class="form-control" placeholder="First Name" name="first_name" required autofocus>
        <label for="inputLastName" class="sr-only">First Name</label>
        <input type="text" id="inputLastName" class="form-control" placeholder="Last Name" name="last_name" required>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required>
        
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password"  name="password" required>
        
        <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
        <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" name="confirm_password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign up</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>