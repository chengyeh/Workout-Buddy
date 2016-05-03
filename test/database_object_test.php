<?php 
require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Database Object Testing</h1>
<p>This seris of test will test the database_object class and it's methods.</p>

<h3 class="sub-header">Test find_all()</h3>
<h3 class="sub-header">Test find_by_id($id=0)</h3>
<h3 class="sub-header">Test find_by_sql($sql="")</h3>
<h3 class="sub-header">Test count_all()</h3>
<h3 class="sub-header">Test count_all_where($condition)</h3>
<h3 class="sub-header">Test instantiate($record)</h3>
<h3 class="sub-header">Test has_attribute($attribute)</h3>
<h3 class="sub-header">Test attributes()</h3>
<h3 class="sub-header">Test sanitized_attributes()</h3>
<h3 class="sub-header">Test save()</h3>
<h3 class="sub-header">Test create()</h3>
<h3 class="sub-header">Test update()</h3>
<h3 class="sub-header">Test delete()</h3>

<?php
include('footer.html');
?>