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
 *	@file session.php
*	@author Dilesh Fernando
*	@date 5/4/2016
*	@comments Class maintains the $_SESSION[] global variable.
*/

/**
 * Session object contains all the data necessary to maintain a connection with the database
 *
 */
class Session {

    private $logged_in=false;
    public $user_id; //Store the user id in session instance
    public $user_name; //Store the user first name in session instance
    public $message;

    /**
     * Constructor for session class
     *
     */
    function __construct(){
        session_start();
        $this->check_login();
        if($this->logged_in) {
            // actions to take right away if user is logged in
        } else {
            // actions to take right away if user is not logged in
        }
    }

    /**
     * Logs a user in and establishes connection with database. Set user_id and user_name according to user information.
     *
     * @param User id
     */
    public function login($user){
    	if($user){
    		$_SESSION['user_id'] = $user->id;
    		$_SESSION['user_name'] = $user->first_name;
    		$this->user_id = $user->id;
    		$this->user_name = $user->first_name;
    
    		$this->logged_in = true;
    	}
    }

    /**
     * Check if a user is logged in.
     *
     * @return Return true if user is logged in. Else return false.
     */
    private function check_login(){
    	if(isset($_SESSION['user_id'])){
    		$this->user_id = $_SESSION['user_id'];
    		$this->user_name = $_SESSION['user_name'];
    		$this->logged_in = true;
    	} else {
    		unset($this->user_id);
    		unset($this->user_name);
    		$this->logged_in = false;
    	}
    }
    
    /**
     * Check if a user is logged in
     *
     * @return Return boolean for whether user is logged in or not
     */
    public function is_logged_in(){
        return $this->logged_in;
    }

 
    
    /**
     * Terminate a users session by logging them out. Set logged_in to false and unset user_id and user_name.
     *
     */
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($this->user_id);
        unset($this->user_name);
        $this->logged_in = false;
    }
    
    /**
     * Set a session message
     * 
     */
    public function message($msg=""){
    	if(!empty($msg)){
    		$_SESSION['message'] = $msg;
    	} else {
    		return $this->message;
    	}
    }
    
    /**
     * Check session message
     *
     */
    private function check_message(){
    	if(isset($_SESSION['message'])){
    		$this->message = $_SESSION['message'];
    		unset($_SESSION['message']);
    	} else {
    		$this->message = "";
    	}
    }
}

//Create instance if session class
$session = new Session();
?>
