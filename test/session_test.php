<?php 
require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Session Testing</h1>
<p>This seris of test will test the Session class and it's methods.</p>

<h3 class="sub-header">Test is_logged_in()</h3>
<h3 class="sub-header">Test login($user)</h3>
<h3 class="sub-header">Test logout()</h3>
<h3 class="sub-header">Test message($msg="")</h3>
<h3 class="sub-header">Test check_login()</h3>
<h3 class="sub-header">Test check_message()</h3>

<?php
include('footer.html');
?>