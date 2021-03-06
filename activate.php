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
 *	@file activate.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Activates the user, when user click the link in the activation email after signup.
*				Note: This feature is not currently used since the email feature is not activated due 
*					  to security reasons at KU server. 
*/

error_reporting(E_ALL);
ini_set("display_errors", 1);

// Include initialization file
require_once('includes/initialize.php');
?>

<?php
//if url parameters are set
if (isset($_GET['x'], $_GET['y']) 
&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
      && (strlen($_GET['y']) == 32 )
      ) {
    
      // Update the database...
      $q = "SELECT * FROM wb_users";
      $q .= " WHERE email='" . $database->escape_value($_GET['x']) . "'";
      $q .= " AND activation_code='" . $database->escape_value($_GET['y']) . "'";
      $q .= " LIMIT 1";
      
      //find the user from database
      $result = User::find_by_sql($q);
      
      if($result){ 
      	//if user found
        $user = array_shift($result);
        $user->active = 1;
        $user->save();
        echo "<h3>Your account is now active. You may now log in.</h3>";
      } else{
        echo '<p class="error">Your account could not be activated. Please re-check the link or contact the system administrator.</p>'; 
      }
    
    } else { 
	  // user not found. Redirect.
      $url = 'http://people.eecs.ku.edu/~dfernand/eecs448/EECS448_Project3'; // Define the URL.
      header("Location: $url");
      exit(); // Quit the script.
    
    } // End of main IF-ELSE.
  ?>
