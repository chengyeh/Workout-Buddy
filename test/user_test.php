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

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
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

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
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

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
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

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
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

			$user = User::find_by_id(19);


			if($user->is_active()==1)
			{

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
						echo "</div>";
			}



			//Returns active status of test user

	</xmp>
</div>

	<?php

		$user = User::find_by_id(19);


			if($user->is_active()==1)
			{

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
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

			$user = User::find_by_id(19);


			if($user->is_active()==1)
			{

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
						echo "</div>";
			}



			//Returns active status of test user

	</xmp>
</div>

	<?php

		$user = User::find_by_id(19);


			if($user->is_active()==1)
			{

				echo "<div class='well' style='background-color: #00ff00'>";
						echo "<strong>Passed</strong>";
						echo "</div>";
			}
			else
			{
				echo "<div class='well' style='background-color: #ff0000'>";
						echo "<strong>Failed</strong>";
						echo "</div>";
			}


	?>










<?php
include('footer.html');
?>
