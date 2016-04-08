<?php
/**
 * Validates a user_email with an emailed code pending successful signup. After validation, user is able to use all features of website.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
?>

<?php
if (isset($_GET['x'], $_GET['y']) 
&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
      && (strlen($_GET['y']) == 32 )
      ) {
    
      // Update the database...
      $q = "SELECT * FROM wb_users";
      $q .= " WHERE email='" . $database->escape_value($_GET['x']) . "'";
      $q .= " AND activation_code='" . $database->escape_value($_GET['y']) . "'";
      $q .= " LIMIT 1";
      
      $result = User::find_by_sql($q);
      
      if($result){
        $user = array_shift($result);
        $user->active = 1;
        $user->save();
        echo "<h3>Your account is now active. You may now log in.</h3>";
      } else{
        echo '<p class="error">Your account could not be activated. Please re-check the link or contact the system administrator.</p>'; 
      }
    
    } else { // Redirect.
    
      $url = 'http://people.eecs.ku.edu/~dfernand/eecs448/EECS448_Project3'; // Define the URL.
      header("Location: $url");
      exit(); // Quit the script.
    
    } // End of main IF-ELSE.
  ?>
