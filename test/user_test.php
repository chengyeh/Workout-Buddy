<?php
require_once('../includes/initialize.php');

?>
<?php
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">User Testing</h1>

full_name()

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
			$user = User::find_by_id(19);
			$user->first_name="Test";
			$user->last_name="User";
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

		$user = User::find_by_id(19);
			$user->first_name="Test";
			$user->last_name="User";
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




<?php
include('footer.html');
?>
