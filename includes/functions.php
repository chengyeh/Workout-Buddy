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