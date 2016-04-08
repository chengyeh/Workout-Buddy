<?php
/**
 * Creates a new challenge object and stores it in the database. 
 * The database object takes in several values for various exercises.
 * The message object contains the following values: who, name, benchpress, pull_ups, treadmill_mileage.
 * After successful storage of challenege object, user is redirected to profile.
 */
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in; if not, throw it back to login page
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

/*
//Create User object
$user = User::find_by_id($session->user_id);

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
    $session->message("No group ID was provided.");
    redirect_to('profile.php');
}
*/
//$challenge = challenge::find_by_id($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

  // Trim all the string in _POST (incoming data):
  /*array_map trims down all the strings in an array and retrun an
    array (hash table?) that does not include any white space*/
  $trimmed = array_map('trim', $_POST);



  //if id exists in the challenge -- update, otherwise, create  ----(update it later)
  //global $database;
  //$query_check = "SELECT * FROM challenge WHERE who=".
  //$id_obj = challenge::find_by_id()
  //so _GET gets id?

  $challenge = new challenge();
  $challenge->who = $trimmed['user_id'];
  $challenge->name = $trimmed['challenge_name'];
  $challenge->bench_press = $trimmed['challenge_BP_lbs'];
  $challenge->pull_ups = $trimmed['challenge_PU_num'];
  $challenge->treadmill_mileage =trimmed['challenge_TMM'];
  $challenge->create();


  //Redirect to profile page
  redirect_to("view_group.php?id={$database->insert_id()}");
}


?>

<!---HTML STARTS HERE --->
<html>
  <head>

    <title>Workout Buddy: Add Challenge</title>

  </head>

  <body>

    <h1>Profile Page: Add accomplished challenge</h1>
    <p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>
    <h2>User Info</h2>
  	<?php
  		echo "<p>User Name: " . $session->user_name. "</p>";
  		echo "<p>User Id: " . $session->user_id . "</p>";
  	?>
    <h2>Update your accomplished challenge!</h2>
    <table>
    <form action="#" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
        <tr><td><label>Your name:</label></td><td><input type="text" name="challenge_name" required /></td></tr>
        <tr><td><label>Bench Press (lbs):</label></td><td><input type="text" name="challenge_BP_lbs" required /></td></tr>
        <tr><td><label>Numbers of pull ups:</label></td><td><input type="text" name="challenge_PU_num" required /></td></tr>
        <tr><td><label>Treadmill mileage:</label></td><td><input type="text" name="challenge_TMM" required></td></tr>
    		<tr><td><button type="submit" name="submit">Update challenge! WooHoo</button></td><td></td></tr>
  	</form>
    </table>

  </body>
</html>
