<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">User Testing</h1>


<h3 class="expand sub-header">Test for full_name()</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			public function full_name()
		    {
		        if(isset($this->first_name) && isset($this->last_name)){
		            return $this->first_name . " " . $this->last_name;
		        }
		        else
		        {
		            return "";
		        }
		    }*/
			$user = new User();
			$user->first_name="Test";
			$user->last_name="User";
			$user->email="test_email@test.com";
			$user->password="test101";
			$user->create();
			$test_user_string=$user->full_name();
			if(strcmp("$test_user_string","Test User")==0)
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


			//Returns full name of test user

	</xmp>
</div>

	<?php


			$user = new User();
			$user->first_name="Test";
			$user->last_name="User";
			$user->email="test_email@test.com";
			$user->password="test101";
			$user->create();
			$test_user_string=$user->full_name();
			if(strcmp("$test_user_string","Test User")==0)
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

<h3 class="expand sub-header">Test for authenticate($email="", $password="")</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			public static function authenticate($email="", $password=""){
	        global $database;
	        $email = $database->escape_value($email);
	        $password = sha1($database->escape_value($password));

	        $sql  = "SELECT * FROM wb_users ";
	        $sql .= "WHERE email = '{$email}' ";
	        $sql .= "AND hashed_password = '{$password}' ";
	        $sql .= "LIMIT 1";

	        $result_array = self::find_by_sql($sql);
	        if(!empty($result_array)){
	            $user = array_shift($result_array);

	            if($user->is_active()){
	                return $user;
	            } else {
	                return false;
	            }
	        }
	        else{
	            return false;
	        }
	    	}
		    */

			$user->email="test_email@test.com";
			$user->password="test101";
			$user->authenticate($user->email,$user->password);

			global $database;
			$sql = "SELECT * FROM wb_users WHERE id=".$user->id;
			$test_user_array = $database->query($sql);
			$pass_trigger=1;
	    	while($test_array = $test_user_array->fetch_assoc())
			{
					$final_test_array=User::find_by_id($test_array['id']);


					if(($final_test_array->email)!=($user->email))
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



			//Returns authentication of test user

	</xmp>
</div>

	<?php


			$user->authenticate($user->email,$user->password);

			global $database;
			$sql = "SELECT * FROM wb_users WHERE id=".$user->id;
			$test_user_array = $database->query($sql);
			$pass_trigger=1;
	    	while($test_array = $test_user_array->fetch_assoc())
			{
					$final_test_array=User::find_by_id($test_array['id']);


					if(($final_test_array->email)!=($user->email))
					{
						$pass_trigger=0;
					}
					if(($final_test_array->hashed_password)!=($user->hashed_password))
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




<h3 class="expand sub-header">Test for is_active()</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			public function is_active()
			{
		        if($this->active == 1){
		            return true;
		        }else{
		            return false;
		        }

		    }
		    }*/

			$user->active=1;


			if($user->is_active()==1)
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



			//Returns active status of test user

	</xmp>
</div>

	<?php



			$user->active=1;
			if($user->is_active()==1)
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





	<h3 class="expand sub-header">Test for display_log()</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			public function display_log()
			{
				global $database;
		    	$sql = "SELECT * FROM wb_log_category WHERE user_id=".$this->id;
		    	$log_array = $database->query($sql);
		    	return $log_array;
			}
		    */

			$test_cat=new Category();
			$test_cat->user_id=$user->id;
			$test_cat->create();
			$log_disp=$user->display_log();
			global $database;
			$sql = "SELECT * FROM wb_log_category WHERE id=".$test_cat->id;
			$test_disp_log_array = $database->query($sql);
			$pass_trigger=1;
			$a=0;
	    	while($test_array = $test_disp_log_array->fetch_assoc())
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



			//Returns active status of test user

	</xmp>
</div>

	<?php

			$test_cat=new Category();
			$test_cat->user_id=$user->id;
			$test_cat->create();
			$log_disp=$user->display_log();
			global $database;
			$sql = "SELECT * FROM wb_log_category WHERE id=".$test_cat->id;
			$test_disp_log_array = $database->query($sql);
			$pass_trigger=1;
			$a=0;
	    	while($test_array = $test_disp_log_array->fetch_assoc())
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



	<h3 class="expand sub-header">Test for find_groups()</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			public function find_groups()
		    {
		    	$sql = "SELECT * FROM wb_group WHERE group_owner=".$this->id. " ORDER BY group_name ASC, group_status DESC";
		    	$groups_object_array = Group::find_by_sql($sql);
		    	return $groups_object_array;
		    }
		    */

			$test_group=new Group();
			$test_group->group_owner=$user->id;
			$test_group->name="test group name";
			$test_group->create();
			$group_disp=$user->find_groups();


	    	while($test_array = $test_find_group_array->fetch_assoc())
			{
				if($test_array->name == $test_group->name)
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



			//Returns active status of test user

	</xmp>
</div>

	<?php

			$test_group=new Group();
			$test_group->group_owner=$user->id;
			$test_group->name="test group name";
			$test_group->create();
			$group_disp=$user->find_groups();


			$pass_trigger=1;
			$a=0;
	    	foreach($group_disp as $value)
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

	<h3 class="expand sub-header">Test for groups_joined()</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			public function groups_joined(){
		    	$sql = "SELECT * FROM wb_group_members WHERE member_id=".$this->id;
		    	$group_members_object_array = GroupMember::find_by_sql($sql);
		    	return $group_members_object_array;
		    }
		    */


			$test_group_mem=new GroupMember();
			$test_group_mem->member_id=$user->id;
			$test_group_mem->group_id=$test_group->id;
			$test_group_mem->create();
			$pass_trigger=0;
			$group_join_array=$user->groups_joined();
			foreach($group_join_array as $value)
			{
				if(($value->group_id)==$test_group->id)
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

			$test_group_mem=new GroupMember();
			$test_group_mem->member_id=$user->id;
			$test_group_mem->group_id=$test_group->id;
			$test_group_mem->create();
			$pass_trigger=0;
			$group_join_array=$user->groups_joined();
			foreach($group_join_array as $value)
			{

				if(($value->group_id)==$test_group->id)
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




<h3 class="expand sub-header">Test for receive_messages()</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			  public function receive_messages()
		      {
		    	global $database;
		    	$a=0;
		    	$sql = "SELECT * FROM wb_messages WHERE receiver=".$this->id." AND del_receive=".$a;
		    	$group_message_array = $database->query($sql);
		    	return $group_message_array;
		      }
		    */


			$test_mess=new Message();
			$test_mess->message="This is a test";
			$test_mess->receiver=$user->id;
			$test_mess->user=$user->id;
			$test_mess->del_receive=0;
			$test_mess->del_sent=0;
			$test_mess->create();

			$pass_trigger=0;
			$test_mess_array=$user->receive_messages();
			foreach($test_mess_array as $value)
			{

				if(($value['id'])==$test_mess->id)
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

			$test_mess=new Message();
			$test_mess->message="This is a test";
			$test_mess->receiver=$user->id;
			$test_mess->user=$user->id;
			$test_mess->del_receive=0;
			$test_mess->del_sent=0;
			$test_mess->create();

			$pass_trigger=0;
			$test_mess_array=$user->receive_messages();
			foreach($test_mess_array as $value)
			{

				if(($value['id'])==$test_mess->id)
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


	<h3 class="expand sub-header">Test for get_messages()</h3>
<div class="well" style="display:none;">
<xmp>
			/*
			  public function get_messages()
		      {
		    	global $database;
		    	$a=0;
		    	$sql = "SELECT * FROM wb_messages WHERE user=".$this->id." AND del_sent=".$a;
		    	$group_message_array = $database->query($sql);
		    	return $group_message_array;
		      }
		    */

			$pass_trigger=0;
			$test_mess_array=$user->get_messages();

			//$user=User:find_by_id($user->id);
			while($get_mess_test = $test_mess_array->fetch_assoc())
			{

				if($get_mess_test['id']==$test_mess->id)
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

			$pass_trigger=0;
			$test_mess_array=$user->get_messages();

			//$user=User:find_by_id($user->id);
			while($get_mess_test = $test_mess_array->fetch_assoc())
			{

				if($get_mess_test['id']==$test_mess->id)
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



		<h3 class="expand sub-header">Test for exercise_routines_added()</h3>
<div class="well" style="display:none;">
<xmp>
			public function exercise_routines_added()
		    {
		    	$sql = "SELECT * FROM wb_routine WHERE user_id=".$this->id;
		    	$exercise_array = Routine::find_by_sql($sql);
		    	return $exercise_array;
		    }

			$test_rout=new Routine();
		    $test_rout->user_id=$user->id;
		    $test_rout->name="Test Routine User";
		    $test_rout->mon=1;
		    $test_rout->create();
			$pass_trigger=0;
			$test_rout_array=$user->exercise_routines_added();

			foreach ($test_rout_array as $value)
			{
				if($value->id == $test_rout->id)
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


		    $test_rout=new Routine();
		    $test_rout->user_id=$user->id;
		    $test_rout->name="Test Routine User";
		    $test_rout->mon=1;
		    $test_rout->create();
			$pass_trigger=0;
			$test_rout_array=$user->exercise_routines_added();

			foreach ($test_rout_array as $value)
			{
				if($value->id == $test_rout->id)
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



	<h3 class="expand sub-header">Test for find_last_routine()</h3>
<div class="well" style="display:none;">
<xmp>
			public function find_last_routine()
    {
    	$sql = "SELECT * FROM wb_routine WHERE user_id=".$this->id;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

			$pass_trigger=0;
			$test_last_array=$user->find_last_routine();

			foreach ($test_last_array as $value)
			{
				if($value->id == $test_rout->id)
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



			$pass_trigger=0;
			$test_last_array=$user->find_last_routine();

			foreach ($test_last_array as $value)
			{
				if($value->id == $test_rout->id)
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


	<h3 class="expand sub-header">Test for find_all_exercises($a,$b)</h3>
<div class="well" style="display:none;">
<xmp>
			public function find_all_exercises($a,$b)
    {
    	$sql = "SELECT * FROM wb_exercise_set WHERE exercise_id=".$a." AND routine_id=".$b;
    	$exercise_array = Exercises::find_by_sql($sql);
    	return $exercise_array;
    }


    		$test_ex=new Exercises();
    		$test_ex->routine_id=$test_rout->id;
    		$test_ex->type=10;
    		$test_ex->create();

			$pass_trigger=1;
			$test_ex_array=$user->find_all_exercises($test_ex->id,$test_rout->id);

			foreach ($test_ex_array as $value)
			{
				if($value->routine_id != $test_rout->id)
				{
					$pass_trigger=0;
				}
				if($value->id != $test_ex->id)
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

		    /*
		    public function find_all_exercises($a,$b)
    {
    	$sql = "SELECT * FROM wb_exercise_set WHERE exercise_id=".$a." AND routine_id=".$b;
    	$exercise_array = Exercises::find_by_sql($sql);
    	return $exercise_array;
    }*/

    		$test_ex=new Exercises();
    		$test_ex->routine_id=$test_rout->id;
    		$test_ex->type=10;
    		$test_ex->create();

			$pass_trigger=1;
			$test_ex_array=$user->find_all_exercises($test_ex->id,$test_rout->id);

			foreach ($test_ex_array as $value)
			{
				if($value->routine_id != $test_rout->id)
				{
					$pass_trigger=0;
				}
				if($value->id != $test_ex->id)
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




	<h3 class="expand sub-header">Test for find_last_exercise($a)</h3>
<div class="well" style="display:none;">
<xmp>

		    public function find_last_exercise($a)
    {
    	$sql = "SELECT * FROM wb_exercise WHERE routine_id=".$a;
    	$exercise_array = Routine::find_by_sql($sql);
    	return $exercise_array;
    }

    		$pass_trigger=1;
			$test_last_ex_array=$user->find_last_exercise($test_rout->id);

			foreach ($test_last_ex_array as $value)
			{
				if($value->id != $test_ex->id)
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



			$pass_trigger=1;
			$test_last_ex_array=$user->find_last_exercise($test_rout->id);

			foreach ($test_last_ex_array as $value)
			{
				if($value->id != $test_ex->id)
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



		<h3 class="expand sub-header">Test for find_type($a)</h3>
<div class="well" style="display:none;">
<xmp>


    		public function find_type($a)
	   {
	   		global $database;
	    	$sql = "SELECT name FROM wb_exercise_type WHERE id=".$a;
	    	$name_type = $database->query($sql);
	    	return $name_type;
	    }



			$pass_trigger=0;
			$test_type_array=$user->find_type(10);

			foreach ($test_type_array as $value)
			{

				if(strcmp($value['name'],"Barbell Deadlifts") == 0)
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


    		/*
    		public function find_type($a)
	   {
	   		global $database;
	    	$sql = "SELECT name FROM wb_exercise_type WHERE id=".$a;
	    	$name_type = $database->query($sql);
	    	return $name_type;
	    }
	    */


			$pass_trigger=0;
			$test_type_array=$user->find_type(10);

			foreach ($test_type_array as $value)
			{

				if(strcmp($value['name'],"Barbell Deadlifts") == 0)
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

	<?php
		$test_ex->delete();
		$test_rout->delete();
		$test_mess->delete();
		$test_group_mem->delete();
		$test_group->delete();
		$test_cat->delete();
		$user->delete();
	?>

<?php
include('footer.html');
?>
