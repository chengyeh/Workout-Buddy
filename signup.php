<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
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
			$user = new User();
      $user->hashed_password = sha1($p);
      $user->first_name = $fn;
      $user->last_name = $ln;
      $user->email = $e;
      $user->active = 1;
      $user->activation_code = $a;
      $user->registration_date = date("Y-m-d H:i:s");
      $user->create();

			if ($database->affected_rows() == 1) { // If it ran OK.
				
// 				// Send the email:
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
				echo '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';
				sleep(10);
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
<!DOCTYPE h2 PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
	<title>Workout Buddy: Sign Up</title>
</head>
<body>
<h2>Sign Up</h2>
	<form action="signup.php" method="post" enctype="multipart/form-data">
			<label>First Name</label>
			<input type="text" name="first_name" class="span3" required /><br/>
			<label>Last Name</label>
			<input type="text" name="last_name" class="span3" required /><br/>
			<label>Email Address</label>
			<input type="email" name="email" class="span3" required /><br/>
			<label>Password</label>
			<input type="password" name="password" class="span3" required /><br/>
			<label>Confirm Password</label>
			<input type="password" name="confirm_password" class="span3" required /><br/>
			<button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
	</form>
</body>
</html>