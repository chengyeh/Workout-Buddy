<?php 
/*
 *	@file functions_test.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Test functions.php functions .
*/

require_once('../includes/initialize.php');

?>
<?php 
include('header.html');
?>
<!-- html goes here -->
<h1 class="page-header">Functions Testing</h1>
<p>Due to nature of the code, these functions in file functions.php are not tested.</p>

<h3 class="sub-header">Test __autoload($class_name)</h3>
<div class="well">
<xmp>
function __autoload($class_name){
    $class_name = strtolower($class_name);
    $path = LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path)){
        require_once($path);
    } else {
        echo("The file {$class_name}.php could not be found.");
    }   
}
</xmp>
</div>

<div class='well' style='background-color:  #b3e0ff'>
	<p>This function is not tested.</p>
</div>

<h3 class="sub-header">Test redirect_to($location = NULL)</h3>
<div class="well">
<xmp>
function redirect_to($location = NULL){
    if($location != NULL){
        header("Location:{$location}");
        exit;
    }
}
</xmp>
</div>
<div class='well' style='background-color:  #b3e0ff'>
	<p>This function is not tested.</p>
</div>


<?php
include('footer.html');
?>