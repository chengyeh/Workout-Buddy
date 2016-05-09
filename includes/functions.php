<?php
/*
*	@file functions.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Helper functions that are used in web app.
*/

/**
 * Automatically load a class that should you want running on a page.
 *
 * @param  Name of class
 */
function __autoload($class_name){
    $class_name = strtolower($class_name);
    $path = LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path)){
        require_once($path);
    } else {
        echo("The file {$class_name}.php could not be found.");
    }
    
}

/**
 * Redirect to new HTML page.
 *
 * @param  Name of file or URL
 */
function redirect_to($location = NULL){
    if($location != NULL){
        header("Location:{$location}");
        exit;
    }
}
?>