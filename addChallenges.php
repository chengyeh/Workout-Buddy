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
//error checking
error_reporting(E_ALL);
ini_set("display_errors", 1);

//check if user logged in; if not, throw it back to login page
require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);

//$challenge = challenge::find_by_id($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 $errors = array();
 $trimmed = array_map('trim', $_POST);
 // Trim all the string in _POST (incoming data):
 /*array_map trims down all the strings in an array and retrun an
   array (hash table?) that does not include any white space*/


 //if id exists in the challenge -- update, otherwise, create  ----(update it later)
 //global $database;
 //$query_check = "SELECT * FROM challenge WHERE who=".
 //$id_obj = challenge::find_by_id()
 //so _GET gets id?
 $uu = $user->id;
 $sql = "SELECT who FROM challenge WHERE who =".$uu.";";
 global $database;
 $result = $database->query($sql);
 $count = 0;
 while($row =$result->fetch_assoc()){
   $count = $count + 1;
 }

 if($count != 0){
   $sql_u = "UPDATE challenge SET name='".$trimmed['challenge_name']."', bench_press='".$trimmed['challenge_BP_lbs']."', pull_ups='".$trimmed['challenge_PU_num']."', treadmill_mileage='".$trimmed['challenge_TMM']."' where who = ".$trimmed['user_id']."; ";
   $database->query($sql_u);
   $result->free();
 }
 else {
   $challenge = new challenge();
   $challenge->who = $trimmed['user_id'];
   $challenge->name = $trimmed['challenge_name'];
   $challenge->bench_press = $trimmed['challenge_BP_lbs'];
   $challenge->pull_ups = $trimmed['challenge_PU_num'];
   $challenge->treadmill_mileage = $trimmed['challenge_TMM'];
   $challenge->create();
 }


 //Redirect
 redirect_to("view_challenges.php");
}//end if

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

   <title>Workout Buddy - Add Challenge</title>

   <!-- Bootstrap core CSS -->
   <link href="dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="dist/css/navbar-fixed-top.css" rel="stylesheet">

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

   <!-- Fixed navbar -->
   <nav class="navbar navbar-default navbar-fixed-top">
     <div class="container">
       <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <!--  <a class="navbar-brand" href="#">Project name</a> -->
         <img id="navbar-logo-image" alt="workout buddy logo" src="images/Workout_Buddy_Logo_small.png">
       </div>
       <div id="navbar" class="navbar-collapse collapse">
         <ul class="nav navbar-nav">
           <li class="active"><a href="profile.php">Home</a></li>
           <li><a href="about_page.php">About</a></li>
           <li><a href="contact.php">Contact</a></li>
           <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More Actions<span class="caret"></span></a>
             <ul class="dropdown-menu">
               <li><a href="add_group.php">Add Group</a></li>
               <li><a href="find_group.php">Find Group</a></li>
               <li><a href="find_user.php">Find User</a></li>
               <li><a href="message_menu.php">Messages</a></li>
               <li role="separator" class="divider"></li>
               <li class="dropdown-header">Progress</li>
               <li><a href="view_log.php">View Log</a></li>
               <li><a href="addChallenges.php">Add Challenge</a></li>
               <li><a href="view_challenges.php">View Challenge</a></li>
             </ul>
           </li>
         </ul>

         <ul class="nav navbar-nav navbar-right" id="navbar-status">
           <li><span class="glyphicon glyphicon-calendar"><a href="show_calendar">Calendar</a></span>&nbsp&nbsp</li>
           <li>
             <span>
             <?php
               $result_set = $database->query("SELECT * FROM wb_messages WHERE read_message=0 AND receiver=".$user->id);
               $number_messages = $database->num_rows($result_set);
               echo "<span class='badge'>{$number_messages}</span>";
             ?>
             <a href="inbox.php">Inbox</a>
             </span>&nbsp&nbsp
           </li>

           <li><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Hi <?php echo $session->user_name; ?>&nbsp&nbsp</li>
           <li><span><a class="btn btn-primary btn-sm" href="logout.php" role="button">Logout</a></span>&nbsp&nbsp</li>
        </ul>

       </div><!--/.nav-collapse -->
     </div>

   </nav>

   <div class="container">

   <!-- Main component for a primary marketing message or call to action -->
   <div class="col-xs-12 col-sm-6 col-md-8">
   <h1>Add accomplished challenge</h1>

   <h2>Update your accomplished challenge!</h2>
   <form action="#" method="post" enctype="multipart/form-data">
       <input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
       <input type="hidden" name="challenge_name" value='<?php echo $user->full_name(); ?>'>


       <fieldset class="form-group">
          <label for="formGroupExampleInput1">Your Name</label>
          <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Name" name="contact_name" value="<?php echo $user->full_name(); ?>" required readonly autofocus>
       </fieldset>


       <fieldset class="form-group">
           <label for="formGroupExampleInput2">Bench Press (lbs):</label>
           <input type="text" class="form-control" id="formGroupExampleInput2" name="challenge_BP_lbs" required />
       </fieldset>
       <fieldset class="form-group">
           <label for="formGroupExampleInput3">Numbers of pull ups:</label>
           <input type="text" name="challenge_PU_num" class="form-control" id="formGroupExampleInput3" required />
       </fieldset>
       <fieldset class="form-group">
           <label for="formGroupExampleInput4">Treadmill mileage:</label>
           <input type="text" name="challenge_TMM" class="form-control" id="formGroupExampleInput4" required />
       </fieldset>
       <button type="submit" name="submit" class="btn btn-default">Update challenge</button>
   </form>

   </div>









   </div> <!-- /container -->


   <!-- Bootstrap core JavaScript
   ================================================== -->
   <!-- Placed at the end of the document so the pages load faster -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
   <script src="dist/js/bootstrap.min.js"></script>
   <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
 </body>
</html>
