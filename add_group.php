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
/**
 * Creates a new group object with various parameter of the users choosing and the user is set as the owner of the group.
 *  The group object contains the following values: group_owner, group_name, group_status, group_description, group_activity
 * If successfully created, the group object is stored in the wb_group and the user is redirected the view_group.php page.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

// Create User object for the current session user.
$user = User::find_by_id($session->user_id);

// Get all the group activity to populate the 
// select box in form
$group_activity = Group::get_activity();

//Store messages
$message = "";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Keep track of errors
    $errors = array();

  	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);

    // Assume invalid values:
    $gn = $gs = $gd = $ga = FALSE;
    
    // Check for group name
    if (isset($trimmed['group_name']) && !empty($trimmed['group_name'])) {
        $gn = $database->escape_value($trimmed['group_name']);
    } else {
        $errors[] = '<p class="error">Please enter a name!</p>';
    }
    
    // Check for group status
    if (isset($trimmed['group_status']) && !empty($trimmed['group_status'])) {
        $gs = $database->escape_value($trimmed['group_status']);
    } else {
        $errors[] = '<p class="error">Please select private or public!</p>';
    }
    
    // Check for group description
    if (isset($trimmed['group_discription']) && !empty($trimmed['group_discription'])) {
        $gd = $database->escape_value($trimmed['group_discription']);
    } else {
        $errors[] = '<p class="error">Please enter a description!</p>';
    }
    
    // Check for group activity
    if (isset($trimmed['group_activity']) && !empty($trimmed['group_activity'])) {
        $ga = $database->escape_value($trimmed['group_activity']);
    } else {
        $errors[] = '<p class="error">Please select an activity!</p>';
    }
    
    if ($gn && $gs && $gd && $ga) { // If everything's OK...
        // Add the group to the database:
        $group = new Group();
        $group->group_owner= $trimmed['user_id'];
        $group->group_name= $gn;
        $group->group_status= $gs;
        $group->group_discription = $gd;
        $group->group_activity = $ga;
        $group->create(); 
        
        $group_member = new GroupMember();
        $group_member->group_id = $database->insert_id();
        $group_member->member_id = $trimmed['user_id'];
        $group_member->create();     
        
        // Unset variables
        unset($gn);
        unset($gs);
        unset($gd);
        unset($ga);
        
        // Redirect to profile page
        redirect_to("view_group.php?id={$database->insert_id()}"); 
         
    } else { // If one of the data tests failed.
        foreach ($errors as $item) {
            $message .= $item . "\n";
        }
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

    <title>Workout Buddy - Add Group</title>

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
	            	// Query unread messages from the wb_messages table and display the count.
	            	$result_set = $database->query("SELECT * FROM wb_messages WHERE 'read'!=0 AND receiver=".$user->id);
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
    
	<div class="col-xs-12 col-sm-6 col-md-8">
	<h2>Add Group</h2>
	<?php 
        if(isset($message) && !empty($message)){
            echo "<div class='alert alert-danger' role='alert'>".$message."</div>";
        }
     ?>
	<form action="#" method="post" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value='<?php echo $session->user_id; ?>'>
	
		<fieldset class="form-group">
		   <label for="formGroupExampleInput">Group Name</label>
		   <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Group Name" name="group_name" value="<?php if(isset($gn) && !empty($gn)){ echo $gn; }?>" required autofocus>
		</fieldset>
  		<fieldset class="form-group">
    		<label for="formGroupExampleInput2">
    		<input type="radio" name="group_status" value="Private" required>&nbsp Private
    		</label>
    		&nbsp
    		<label for="formGroupExampleInput2">
			<input type="radio" name="group_status" value="Public">&nbsp Public
			</label>
  		</fieldset>
  		<fieldset class="form-group">
		   <label for="formGroupExampleInput">Group Description</label>
		   <textarea name="group_discription" class="form-control" id="formGroupExampleInput" placeholder="Group Description"rows="4" cols="50" required><?php if(isset($gd) && !empty($gd)){ echo $gd; }?></textarea>
		</fieldset>
		<fieldset class="form-group">
		   <label for="formGroupExampleInput">Group Activity</label>
		   <select name="group_activity" class="form-control" required>
		   <?php 
		   		// Query group activities from wb_group_activity table
		   		echo "<option value=''></option>";
		   		foreach ($group_activity as $key => $value){
					echo "<option value='{$value}'>{$value}</option>";
				}		   
		   ?>	  
			</select>
		</fieldset>
		<button type="submit" name="submit" class="btn btn-default">Add group</button>
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