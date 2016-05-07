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

<h3 class="expand sub-header">Test for adding a group member to a group: get_members()</h3>
<div class="well" style="display:none;">
<xmp>


//This test will create a group member for the group

//The function for this is:
public function get_members()
{
	global $database;
	$sql = "SELECT * FROM wb_group_members WHERE group_id=".$this->id;
	$group_member_array = $database->query($sql);
	return $group_member_array;
}

$group_member_test = new GroupMember();
$group_member_test->group_id = $group_test->id;
$group_member_test->member_id = $group_test->group_owner;
$group_member_test->create();

global $database;

$group_member_test_array = $group_test->get_members();
$pass_trigger=0;
while($test_array = $group_member_test_array->fetch_assoc())
{

	if($test_array['id'] == $group_member_test->id)
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
	</xmp>
</div>


	<?php

	$group_member_test = new GroupMember();
	$group_member_test->group_id = $group_test->id;
	$group_member_test->member_id = $group_test->group_owner;
	$group_member_test->create();

	global $database;

    	$group_member_test_array = $group_test->get_members();
    	$pass_trigger=0;
    	while($test_array = $group_member_test_array->fetch_assoc())
		{

					if($test_array['id'] == $group_member_test->id)
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


	<h3 class="expand sub-header">Test for adding a group member to a group: get_member_id_array()</h3>
<div class="well" style="display:none;">
<xmp>


//This test will create a group member for the group

//The function for this is:
public function get_member_id_array()
{
	global $database;
	$sql = "SELECT member_id FROM wb_group_members WHERE group_id=".$this->id;
	$member_id_array = array();
	$group_member_array = $database->query($sql);
	while($member_id = $group_member_array->fetch_assoc())
	{
	    $member_id_array[] = $member_id;
	}
	return  $member_id_array;
}

global $database;

$group_member_test_array = $group_test->get_member_id_array();
$pass_trigger=0;
while($test_array = $group_member_test_array->fetch_assoc())
{

	if($test_array['id'] == $group_member_test->id)
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
	</xmp>
</div>


	<?php

	$group_member_test = new GroupMember();
	$group_member_test->group_id = $group_test->id;
	$group_member_test->member_id = $group_test->group_owner;
	$group_member_test->create();

	global $database;

    	$group_member_test_array = $group_test->get_members();
    	$pass_trigger=0;
    	while($test_array = $group_member_test_array->fetch_assoc())
		{

					if($test_array['id'] == $group_member_test->id)
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

	<h3 class="expand sub-header">Test for querying a group activity: get_activity()</h3>
<div class="well" style="display:none;">
<xmp>


//This test will demonstrate how to obtain an activity from the wb_group_activity

//The function for this is:
public static function get_activity()
{
	global $database;
	$sql = "SELECT * FROM wb_group_activity ORDER BY activity ASC";
	$group_activity_result_set = $database->query($sql);

	$group_activity_array = array();

	while($row = $group_activity_result_set->fetch_assoc()){
		$group_activity_array[] = $row['activity'];
	}

	return($group_activity_array);
}

$group_activity_test_array=$group_test->get_activity();
$pass_trigger=0;
foreach($group_activity_test_array as $value)
{
	if(strcmp($value,"Football")==0)
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
	</xmp>
</div>


	<?php

		$group_activity_test_array=$group_test->get_activity();
    	$pass_trigger=0;
    	foreach($group_activity_test_array as $value)
    	{
    		if(strcmp($value,"Football")==0)
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
