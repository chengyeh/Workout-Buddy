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
    <h1>View Challenge Page</h1>
      <p><a href="profile.php">Profile</a>|<a href="logout.php">logout</a></p>
      <h2>User Info</h2>
      <?php
      	echo "<p>User Name: ". $user->full_name() . "<br/>";
      	echo "<p>User Id: " . $session->user_id . "</p>";
      ?>
      <h4>At WorkBuddy, we challenge our buddies to become the next Mr. Universe</h2>
      <!---Display current leader board--->
      <table>
      <?php

          if($result = challenge::get_BP200()){
              echo "<tr>Here's our member(s) who bench press over 200 lbs<tr>";
              echo "<tr><td>Name:</td><td>lbs</td>";
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
       ?>
     </table>

  </body>
</html>
