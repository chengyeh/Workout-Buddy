<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object for current session user
$user = User::find_by_id($session->user_id);

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
    $session->message("No group ID was provided.");
    redirect_to('profile.php');
}

//Create Group object from ID in the URL 
$group = Group::find_by_id($_GET['id']);
if(!$group){
    $session->message("Unable to be find group.");
    redirect_to('profile.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $errors = array();

    if(!empty($_POST['user_id_array']))
    {
        foreach($_POST['user_id_array'] as $member_id)
        {
            // Add the group member to the database: 
            $group_member = new GroupMember();
            $group_member->group_id = $group->id;   
            $group_member->member_id = $member_id;
         
            $group_member->create();
        }

        //Redirect to view group page
        redirect_to("view_group.php?id={$group->id}");
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

    <title>Workout Buddy: Add Members</title>

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
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More Actions<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="add_group.php">Add Group</a></li>
                <li><a href="find_group.php">Find Group</a></li>
                <li><a href="find_user.php">Find User</a></li>
                <li><a href="message_menu.php">Messages</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="addChallenges.php">Add Challenge</a></li>
                <li><a href="view_challenges.php">View Challenge</a></li>
              </ul>
            </li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right" id="navbar-status">
            <li><span ><span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp Hi <?php echo $session->user_name; ?>!&nbsp &nbsp<a class="btn btn-primary btn-sm" href="logout.php" role="button">Logout</a></span>
        </div><!--/.nav-collapse -->
      </div>
      
    </nav>

    <div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <h1>Add Members to Group</h1>
    
    <h2><?php echo $group->group_name; ?></h2>
    <!-- <?php 
       echo "<p>Group Name: ". $group->group_name . "<br/>";
	   echo "<p>Group Activity: ". $group->group_activity . "<br/>";
       echo "<p>Owner: ". $user->full_name() . "<br/>";
    ?> -->
    <p><a class='btn btn-default' href="view_group.php?id=<?php echo $group->id ?>" role='button'>View Group</a></p>
    
    <h2>Add Members</h2>
    <?php
    	//Get all existing users into array  
        $users = User::find_all();
		//Get all group members id
        $group_member_id_array = $group->get_member_id_array();
        if(!empty($users)){
            echo "<form action='#' method='post'><table>";
			echo "<table class='table'><tr><th>Name</th><th class='text-center'>Add</th></tr>";
            foreach ($users as $user){
            		//Do not display current user
                    if($user->id != $session->user_id)
                    {
                        $id_exist = false;
						//If the user is already in the group, do not display his/her name
                        for($i = 0; $i < count($group_member_id_array); $i++)
                        {
                            if($user->id == $group_member_id_array[$i]['member_id'])
                            {
                                $id_exist = true;
                            }
                        }
						//Display the user who is not in the group
                        if($id_exist == false)
                        {
                        	echo "<tr><td><a href='view_profile.php?id={$user->id}'>".  $user->full_name() ."</a></td>";
                            echo "<td class='text-center'><input type='checkbox' name='user_id_array[]' value='{$user->id}'></td></tr>";
                            
                        } 
                    }   
            }
            echo "<tr><td></td><td class='text-center'><button type='submit' class='btn btn-default' name='add_members'>Add Members</button></td></tr></table>";
            echo "</form>";
        }else{
            echo  "No users<br/>";
        }   
    ?>
  	
  	
  	
  	
  	
  	
  	
  	
  	
  	
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


















<!-- <html>
    <head>
        <title><?php echo $group->group_name ?></title>
    </head>
    <body>
        <h1>Add Members to Group</h1>
        <p><a href="profile.php">Profile</a>|<a href="view_group.php?id=<?php echo $group->id ?>">View Group</a>|<a href="logout.php">logout</a></p>
        <h2>User Info</h2>
        <?php 
            echo "<p>User Name: ". $user->full_name() . "<br/>";
            echo "<p>User Id: " . $session->user_id . "</p>";
        ?>
        
        <h2>User Group Info</h2>
        <?php 
            echo "<p>Grop Name: ". $group->group_name . "<br/>";
            echo "<p>Grop Id: ". $group->id . "<br/>";
        ?>
        
        <h2>User Group Add Members</h2>
        <?php
        	//Get all existing users into array  
            $users = User::find_all();
			//Get all group members id
            $group_member_id_array = $group->get_member_id_array();
            if(!empty($users)){
                echo "<form action='#' method='post'><table>";
                foreach ($users as $user){
                		//Do not display current user
                        if($user->id != $session->user_id)
                        {
                            $id_exist = false;
							//If the user is already in the group, do not display his/her name
                            for($i = 0; $i < count($group_member_id_array); $i++)
                            {
                                if($user->id == $group_member_id_array[$i]['member_id'])
                                {
                                    $id_exist = true;
                                }
                            }
							//Display the user who is not in the group
                            if($id_exist == false)
                            {
                                echo "<tr><td><input type='checkbox' name='user_id_array[]' value='{$user->id}'></td>";
                                echo "<td><a href='view_profile.php?id={$user->id}'>".  $user->full_name() ."</a></td></tr>";
                            } 
                        }   
                }
                echo "</table>";
                echo "<button type='submit' name='add_members'>Add Member(s)</button></form>";
            }else{
                echo  "No users<br/>";
            }   
        ?>
    </body>
</html> -->