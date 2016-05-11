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
 * Creates a new group_member object in a group where the user is not the owner. Allows an user to join a pre-existing group.
 * The add_public_group_member object contains the following values: user, group_id, member_id.
 * If successfully created, the user is listed as a group_member of the group and redirected to the view_group.php page.
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('includes/initialize.php');
if(!$session->is_logged_in()){ redirect_to("login.php"); }

// If the ID field is empty return the user to profile page
if (empty($_GET['user_id']) && empty($_GET['group_id'])){
    $session->message("No group ID was provided.");
    redirect_to('profile.php');
}else{
	// Add user to the group (create a row in wb_group_members table)
	$user_id = $_GET['user_id'];
	$group_id = $_GET['group_id'];
	
	echo "user id: ". $user_id . "Group id: " . $group_id . "<br/>";
	
	$group_member = new GroupMember();
	$group_member->group_id = $group_id;
    $group_member->member_id = $user_id;
    $group_member->create();
    redirect_to('view_group.php?id='.$group_id);
}

?>