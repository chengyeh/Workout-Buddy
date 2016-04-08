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
      <!---Display current leader board--->
      <center>
      <table>
      <?php

          if($result = challenge::bp_top3()){
              echo "<tr><td><h5>BENCH PRESS</h5></td><td><h5>TOP 3</h5></td><tr>";
              echo "<tr><td></td><td>lbs</td>";
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
          echo "<tr><td>---------------------------</td><td>-----------------</td></td>";
          if($result = challenge::pu_top3()){
              echo "<tr><td><h5>PULL UPs</h5></td><td><h5>TOP 3</h5><td><tr>";
              echo "<tr><td></td><td>numbers</td>";
              while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" .$row["name"]  . "</td>";
                echo "<td>" .$row["pull_ups"] . "</td>";
                echo "</tr>";
            }
            $result->free();
          }//end if
          else{
            echo "Looks like no one bench press more than 200lbs";
          }
          echo "<tr><td>---------------------------</td><td>-----------------</td></td>";
          if($result = challenge::tm_top3()){
              echo "<tr><td><h5>Treadmill</h5></td><td><h5>TOP 3</h5><td><tr>";
              echo "<tr><td></td><td>miles</td>";
              while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" .$row["name"]  . "</td>";
                echo "<td>" .$row["treadmill_mileage"] . "</td>";
                echo "</tr>";
            }
            $result->free();
          }//end if
          else{
            echo "Looks like no one bench press more than 200lbs";
          }
       ?>
     </table>
   </center>
  </body>
</html>
