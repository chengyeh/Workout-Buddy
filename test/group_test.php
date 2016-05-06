<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Group Testing</h1>

<h3 class="expand sub-header">Test for creating a group</h3>
<div class="well" style="display:none;">
<xmp>


	//This test will test if a group can be created.
	$group = new Group();
	$group->group_owner= 19;
    $group->group_name= "Test Group";
    $group->group_status= "Public";
    $group->group_discription = "This group is for testing";
    $group->group_activity = "Basketball";
    $group->create();

	</xmp>
</div>


	<?php
	$group_test = new Group();
	$group_test->group_owner= 19;
    $group_test->group_name= "Test Group";
    $group_test->group_status= "Public";
    $group_test->group_discription = "This group is for testing";
    $group_test->group_activity = "Basketball";
    $group_test->create();

	global $database;
    	$sql = "SELECT * FROM wb_group WHERE id=".$group_test->id;
    	$group_test_array = $database->query($sql);
    	$pass_trigger=1;
    	while($test_array = $group_test_array->fetch_assoc())
		{

					$set_array=Group::find_by_id($test_array['id']);
					if(($set_array->group_name)!=$group_test->group_name)
					{
						$pass_trigger=0;
					}

					if(($set_array->group_status)!=$group_test->group_status)
					{
						$pass_trigger=0;
					}
					if(($set_array->id)!=$group_test->id)
					{
						$pass_trigger=0;
					}
					if(($set_array->group_owner)!=$group_test->group_owner)
					{
						$pass_trigger=0;
					}

		}
		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>

<h3 class="expand sub-header">Test for adding a group member to a group</h3>
<div class="well" style="display:none;">
<xmp>


	//This test will create a group member for the group
	$group_member_test = new GroupMember();
	$group_member_test->group_id = $group_test->id;
	$group_member_test->member_id = $group_test->group_owner;
	$group_member_test->create();

	global $database;
    	$sql = "SELECT * FROM wb_group_members WHERE id=".$group_member_test->id;
    	$group_member_test_array = $database->query($sql);
    	$pass_trigger=1;
    	while($test_array = $group_member_test_array->fetch_assoc())
		{

					$set_array=GroupMember::find_by_id($test_array['id']);
					if(($set_array->group_id)!=$group_test->id)
					{
						$pass_trigger=0;
					}
					if(($set_array->group_owner)!=$group_test->group_owner)
					{
						$pass_trigger=0;
					}

		}
		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	</xmp>
</div>


	<?php

	$group_member_test = new GroupMember();
	$group_member_test->group_id = $group_test->id;
	$group_member_test->member_id = $group_test->group_owner;
	$group_member_test->create();

	global $database;
    	$sql = "SELECT * FROM wb_group_members WHERE id=".$group_member_test->id;
    	$group_member_test_array = $database->query($sql);
    	$pass_trigger=1;
    	while($test_array = $group_member_test_array->fetch_assoc())
		{

					$set_array=GroupMember::find_by_id($test_array['id']);

					if(($set_array->group_id)!=$group_test->id)
					{
						$pass_trigger=0;
					}
					if(($set_array->member_id)!=$group_test->group_owner)
					{
						$pass_trigger=0;
					}

		}
		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>

	<h3 class="expand sub-header">Test for querying a group activity</h3>
<div class="well" style="display:none;">
<xmp>


		//This test will demonstrate how to obtain an activity from the wb_group_activity
		global $database;
    	$sql = "SELECT * FROM wb_group_activity";
    	$group_activity_test_array = $database->query($sql);
    	$a=0;
    	while($test_array = $group_activity_test_array->fetch_assoc())
		{

					$a=$a+1;

		}
		if($a==10)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	</xmp>
</div>


	<?php

	global $database;
    	$sql = "SELECT * FROM wb_group_activity";
    	$group_activity_test_array = $database->query($sql);
    	$pass_trigger=0;
    	while($test_array = $group_activity_test_array->fetch_assoc())
		{
					$activity_name = $test_array['activity'];
					if($activity_name=="Football")
					{
						$pass_trigger=1;
					}
		}
		if($pass_trigger==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>


		<h3 class="expand sub-header">Test for deleting a group member</h3>
<div class="well" style="display:none;">
<xmp>


		//This test will demonstrate how to delete a group member from a group
		$temp_test_memb=$group_member_test->id;
			$database->query("DELETE FROM wb_group_members WHERE group_id = '" . $group_test->id . "'");


			global $database;

    	$sql = "SELECT * FROM wb_group_members WHERE id=".$temp_test_memb;
    	$memb_delete_test_array = $database->query($sql);
    	$a=1;
    	while($test_array = $memb_delete_test_array->fetch_assoc())
		{
					$a=$a+1;
		}
		if($a==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	</xmp>
</div>


	<?php


			$temp_test_memb=$group_member_test->id;
			$database->query("DELETE FROM wb_group_members WHERE group_id = '" . $group_test->id . "'");


			global $database;

    	$sql = "SELECT * FROM wb_group_members WHERE id=".$temp_test_memb;
    	$memb_delete_test_array = $database->query($sql);
    	$a=1;
    	while($test_array = $memb_delete_test_array->fetch_assoc())
		{
					$a=$a+1;
		}
		if($a==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>


	<h3 class="expand sub-header">Test for deleting a group</h3>
<div class="well" style="display:none;">
<xmp>


		//This test will demonstrate how to delete a group
		$temp_test_group=$group_test->id;
			$group_test->delete();


			global $database;

    	$sql = "SELECT * FROM wb_group WHERE id=".$temp_test_group;
    	$group_delete_test_array = $database->query($sql);
    	$a=1;
    	while($test_array = $group_delete_test_array->fetch_assoc())
		{
					$a=$a+1;
		}
		if($a==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	</xmp>
</div>


	<?php


			$temp_test_group=$group_test->id;
			$group_test->delete();


			global $database;

    	$sql = "SELECT * FROM wb_group WHERE id=".$temp_test_group;
    	$group_delete_test_array = $database->query($sql);
    	$a=1;
    	while($test_array = $group_delete_test_array->fetch_assoc())
		{
					$a=$a+1;
		}
		if($a==1)
		{
			echo "<div class='well' style='background-color: #b3ffcc'>";
				echo "<strong>PASSED</strong>";
				echo "</div>";
		}
		else
		{
			echo "<div class='well' style='background-color: #ffd6cc'>";
				echo "<strong>FAILED</strong>";
				echo "</div>";
		}
	?>

<?php
include('footer.html');
?>
