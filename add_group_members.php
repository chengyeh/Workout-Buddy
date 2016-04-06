<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//Create User object
$user = User::find_by_id($session->user_id);

//If the ID field is empty return the user to profile page
if (empty($_GET['id'])){
    $session->message("No group ID was provided.");
    redirect_to('profile.php');
}

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
<html>
<head>
    
</head>
    <body>
    <h1>Add Members to Group</h1>
    <p><a href="profile.php">Profile</a>|<a href="view_group.php?id=1">Profile</a>|<a href="logout.php">logout</a></p>
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
        $users = User::find_all();
        $group_members = $group->get_members();
        print_r($group_members);
        if(!empty($users)){
            echo "<form action='#' method='post'><table>";
            foreach ($users as $user){
                // print_r($users);
                // $row = $group_members->fetch_assoc();
                // foreach($group_members["member_id"] as $member_in_group){
                    if($user->id != $session->user_id)
                    {
                        echo "<tr><td><input type='checkbox' name='user_id_array[]' value='{$user->id}'></td>";
                        echo "<td>".  $user->full_name() ."</td></tr>"; 
                    }   
                // }
            }
            echo "</table>";
            
            echo "<button type='submit' name='add_members'>Add Member(s)</button></form>";
        }else{
            echo  "No users<br/>";
        }   
    ?>
    </body>
</html>