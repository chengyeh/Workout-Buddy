<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

//If the ID field is empty return the user to profile page
if (empty($_GET['user_id']) && empty($_GET['group_id'])){
    $session->message("No group ID was provided.");
    redirect_to('profile.php');
}else{
	
	$user_id = $_GET['user_id'];
	$group_id = $_GET['group_id'];
	
	echo "user id: ". $user_id . " Group id: " . $group_id . "<br/>";
	
  	$database->query("DELETE FROM wb_group_members WHERE group_id = '{$group_id}' AND member_id='{$user_id}'");
  
    redirect_to('view_group.php?id='.$group_id);
}


?>